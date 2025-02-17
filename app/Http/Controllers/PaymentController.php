<?php
 
namespace App\Http\Controllers;
 
use Exception;
use Http;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Log;
 
class PaymentController extends Controller
{
    /**
     * Initiates the PhonePe payment process.
     */
    public function phonePe()
    {
        $data = [
            "merchantId" => env('PHONEPE_MERCHANT_ID'),
            "merchantTransactionId" => "MT7850590068188104",
            "merchantUserId" => "MUID123",
            "amount" => 10000,
            "redirectUrl" => "https://webhook.site/redirect-url",
            "redirectMode" => "REDIRECT",
            "callbackUrl" => "https://webhook.site/callback-url",
            "mobileNumber" => "9999999999",
            "paymentInstrument" => [
                "type" => "PAY_PAGE"
            ],
        ];
 
 
 
        $encode = base64_encode(json_encode($data));
        $saltKey = env('PHONEPE_SALT_KEY');
        $saltIndex = env('PHONEPE_SALT_INDEX');
        $string = $encode . '/pg/v1/pay' . $saltKey;
        $sha256 = hash('sha256', $string);
        $finalXHeader = $sha256 . '###' . $saltIndex;
 
        // Log the request for debugging
        // Log::debug('Request URL: ' . 'https://api-preprod.phonepe.com/apis/merchant-simulator/pg/v1/pay');
        // Log::debug('Request Payload: ' . json_encode(['request' => $encode]));
        // Log::debug('X-VERIFY Header: ' . $finalXHeader);
 
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-VERIFY' => $finalXHeader,
        ])->post('https://api-preprod.phonepe.com/apis/merchant-simulator/pg/v1/pay', [
                    'request' => $encode,
                ]);
 
        // Debug: Output the response from PhonePe
        return response()->json($response->json());
    }
    public function initiatePayment(Request $request)
    {        
        try {
            $data = $request->validate([
                'amount' => 'required|numeric',
                'transactionId' => 'required|string',
                'userId' => 'required|string',
                'userEmail' => 'nullable|email',
                'checkoutId' => 'required|string',
                'bookId' => 'nullable|string',
                'date' => 'nullable|string',
                'time' => 'nullable|string',
                'addressId' => 'required|string',
            ]);
 
            $amountInPaise = $data['amount'] * 100;
            $saltKey = env('PHONEPE_SALT_KEY');
            $merchantId = env('PHONEPE_MERCHANT_ID');
            $keyIndex = env('PHONEPE_SALT_INDEX');
            $baseUrl = env('BASE_URL');
 
            $redirectUrl = "{$baseUrl}/api/paymentstatus?id={$data['transactionId']}&userId={$data['userId']}&userEmail={$data['userEmail']}&checkoutId={$data['checkoutId']}&bookId={$data['bookId']}&date={$data['date']}&time={$data['time']}&addressId={$data['addressId']}";
            $callbackUrl = "{$baseUrl}/api/paymentstatus?id={$data['transactionId']}";
 
            $requestData = [
                'merchantId' => $merchantId,
                'merchantTransactionId' => $data['transactionId'],
                'merchantUserId' => $data['userId'],
                'amount' => $amountInPaise,
                'redirectUrl' => $redirectUrl,
                'redirectMode' => 'POST',
                'callbackUrl' => $callbackUrl,
                'paymentInstrument' => [
                    'type' => 'PAY_PAGE',
                ],
            ];
 
            // Prepare the payload
            $payload = json_encode($requestData);
            $payloadMain = base64_encode($payload);
 
            // Generate checksum
            $string = $payloadMain . "/pg/v1/pay" . $saltKey;
            $sha256 = hash('sha256', $string);
            $checksum = $sha256 . '###' . $keyIndex;
 
            // Determine API URL based on environment
            $apiUrl = (env('PHONEPE_ENV') === 'PROD') ?
                'https://api.phonepe.com/apis/hermes/pg/v1/pay' :
                'https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay';
 
            // Send the request to PhonePe API
            $response = Http::withHeaders([
                'accept' => 'application/json',
                'Content-Type' => 'application/json',
                'X-VERIFY' => $checksum,
            ])->post($apiUrl, [
                        'request' => $payloadMain,
                    ]);
 
            // Handle the response
            $responseData = $response->json();
 
            if ($responseData['success'] && isset($responseData['data']['instrumentResponse']['redirectInfo']['url'])) {
                return response()->json([
                    'success' => true,
                    'paymentUrl' => $responseData['data']['instrumentResponse']['redirectInfo']['url'],
                ]);
            } else {
                throw new Exception('Payment initiation failed');
            }
        } catch (Exception $e) {
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
        // Log the input data (for debugging)
        $input = $request->all();
        dd($input); // Output the request data for debugging purposes
    }
}
 
 