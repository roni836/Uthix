<?php
 
 namespace App\Http\Controllers;

 use App\Models\Payment;
 use App\Models\Order;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Http;
 use Illuminate\Support\Facades\Log;
 use Illuminate\Support\Facades\DB;
 use Exception;
 
 class PaymentController extends Controller
 {
     /**
      * Initiates the PhonePe payment process and stores initial payment data.
      */
     public function initiatePayment(Request $request)
     {
         DB::beginTransaction();
 
         try {
             // Validate Request Data
             $data = $request->validate([
                 'order_id' => 'required|exists:orders,id',
                 'amount' => 'required|numeric',
                 'user_id' => 'required|exists:users,id',
             ]);
 
             // Convert amount to paise
             $amountInPaise = $data['amount'] * 100;
 
             // Generate a unique transaction ID
             $merchantTransactionId = 'TXN' . time() . rand(1000, 9999);
 
             // Store initial payment data in the database
             $payment = Payment::create([
                 'order_id' => $data['order_id'],
                 'user_id' => $data['user_id'],
                 'amount' => $data['amount'],
                 'currency' => 'INR',
                 'payment_status' => 'pending',
                 'status' => 'pending',
                 'transaction_id' => $merchantTransactionId,
             ]);
 
             // Prepare Request Data for PhonePe
             $requestData = [
                 'merchantId' => env('PHONEPE_MERCHANT_ID'),
                 'merchantTransactionId' => $merchantTransactionId,
                 'merchantUserId' => $data['user_id'],
                 'amount' => $amountInPaise,
                 'redirectUrl' => route('payment.response', ['transaction_id' => $merchantTransactionId]),
                 'callbackUrl' => route('payment.callback'),
                 'paymentInstrument' => ['type' => 'PAY_PAGE'],
             ];
 
             // Generate Encrypted Payload
             $payload = json_encode($requestData);
             $payloadMain = base64_encode($payload);
 
             // Generate Checksum
             $saltKey = env('PHONEPE_SALT_KEY');
             $keyIndex = env('PHONEPE_SALT_INDEX');
             $string = $payloadMain . "/pg/v1/pay" . $saltKey;
             $sha256 = hash('sha256', $string);
             $checksum = $sha256 . '###' . $keyIndex;
 
             // Determine API URL based on environment
             $apiUrl = (env('PHONEPE_ENV') === 'PROD') ?
                 'https://api.phonepe.com/apis/hermes/pg/v1/pay' :
                 'https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay';
 
             // Send Request to PhonePe
             $response = Http::withHeaders([
                 'accept' => 'application/json',
                 'Content-Type' => 'application/json',
                 'X-VERIFY' => $checksum,
             ])->post($apiUrl, ['request' => $payloadMain]);
 
             // Get Response
             $responseData = $response->json();
 
             if ($responseData['success'] && isset($responseData['data']['instrumentResponse']['redirectInfo']['url'])) {
                 DB::commit();
                 return response()->json([
                     'success' => true,
                     'paymentUrl' => $responseData['data']['instrumentResponse']['redirectInfo']['url'],
                 ]);
             } else {
                 throw new Exception('Payment initiation failed');
             }
         } catch (Exception $e) {
             DB::rollBack();
             Log::error('Payment initiation error:', ['error' => $e->getMessage()]);
             return response()->json([
                 'error' => 'Payment initiation failed',
                 'details' => $e->getMessage(),
             ], 500);
         }
     }
 
     /**
      * Handle the response from PhonePe.
      */
     public function response(Request $request)
     {
         $transactionId = $request->query('transaction_id');
         $payment = Payment::where('transaction_id', $transactionId)->first();
 
         if (!$payment) {
             return response()->json(['error' => 'Payment record not found'], 404);
         }
 
         return response()->json([
             'message' => 'Payment initiated successfully',
             'payment_status' => $payment->payment_status,
         ]);
     }
 
     /**
      * Handle the callback from PhonePe and update the payment status in the database.
      */
     public function callback(Request $request)
     {
         try {
             $responseData = $request->all();
             Log::info('PhonePe Callback Data:', $responseData);
 
             if (!isset($responseData['transactionId'])) {
                 return response()->json(['error' => 'Invalid transaction ID'], 400);
             }
 
             // Fetch Payment Record
             $payment = Payment::where('transaction_id', $responseData['transactionId'])->first();
             if (!$payment) {
                 return response()->json(['error' => 'Payment not found'], 404);
             }
 
             // Update Payment Status
             $payment->update([
                 'payment_status' => $responseData['code'] === 'PAYMENT_SUCCESS' ? 'success' : 'failed',
                 'transaction_fee' => $responseData['transactionFee'] ?? null,
                 'transaction_date' => now(),
                 'status' => $responseData['code'] === 'PAYMENT_SUCCESS' ? 'completed' : 'failed',
                 'error_reason' => $responseData['message'] ?? null,
             ]);
 
             // Update Order Status if Payment is Successful
             if ($payment->payment_status === 'success') {
                 Order::where('id', $payment->order_id)->update(['status' => 'paid']);
             }
 
             return response()->json(['message' => 'Payment status updated successfully']);
         } catch (Exception $e) {
             Log::error('Payment callback error:', ['error' => $e->getMessage()]);
             return response()->json(['error' => 'Failed to process payment status'], 500);
         }
     }
 }
 