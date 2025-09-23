<?php
 
namespace App\Http\Controllers;
 
use App\Models\Payment;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
 
class PaymentController extends Controller
{
 
    public function createPayment(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Unauthorized'], 401);
        }
 
        $order = Order::where('id', $request->order_id)->where('user_id', $user->id)->first();
        if (!$order) {
            return response()->json(['status' => false, 'message' => 'Order not found'], 404);
        }
 
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $orderData = [
            'receipt' => 'order_' . $order->id,
            'amount' => ($order->total_amount + $order->shipping_charge) * 100, // Convert to paise
            'currency' => 'INR',
            'payment_capture' => 1
        ];
 
        try {
            $razorpayOrder = $api->order->create($orderData);
 
            // Store the payment record in the database
            $payment = Payment::create([
                'order_id' => $order->id,
                'user_id' => $user->id,
                'amount' => $order->total_amount + $order->shipping_charge,
                'currency' => 'INR',
                'receipt_no' => $razorpayOrder['receipt'],
                'payment_id' => null, // Will be updated after successful payment
                'transaction_id' => $razorpayOrder['id'], // Store Razorpay order ID
                'payment_method' => $request->payment_method ?? 'razorpay',
                'payment_status' => 'pending', // Payment is still pending
                'status' => 'pending'
            ]);
 
            $amountInInr = $razorpayOrder['amount'] / 100;
            return response()->json([
                'status' => true,
                'message' => 'Razorpay order created successfully',
                'razorpay_order_id' => $razorpayOrder['id'],
                'amount' => $amountInInr,
                'currency' => $razorpayOrder['currency'],
                'order_number' => $order->order_number,
                'payment' => $payment
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create Razorpay order',
                'error' => $e->getMessage()
            ], 500);
        }
    }
 
 
    public function callback(Request $request)
    {
        $razorpayOrderId = $request->razorpay_order_id;
        $razorpayPaymentId = $request->razorpay_payment_id;
        $razorpaySignature = $request->razorpay_signature;
 
        // Find the payment record using the Razorpay order ID
        $payment = Payment::where('transaction_id', $razorpayOrderId)->first();
 
        if (!$payment) {
            return response()->json([
                'status' => false,
                'message' => 'Payment not found'
            ], 404);
        }
 
        // Verify the payment signature using Razorpay API
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        try {
            $attributes = [
                'razorpay_order_id' => $razorpayOrderId,
                'razorpay_payment_id' => $razorpayPaymentId,
                'razorpay_signature' => $razorpaySignature,
            ];
 
            // Verify the payment signature
            $api->utility->verifyPaymentSignature($attributes);
 
            // Now, we insert all the necessary details into the `payments` table
            $payment->update([
                'payment_id' => $razorpayPaymentId,
                'payment_status' => 'successful',
                'status' => 'completed',
                'receipt_no' => $request->razorpay_order_id, // Optional: You can use any field from Razorpay data
                'transaction_fee' => $request->transaction_fee ?? null, // If available
                'transaction_id' => $razorpayOrderId,
                'transaction_date' => now(), // You can store the current timestamp
                'payment_card_id' => $request->payment_card_id ?? null,
                'method' => 'razorpay', // Assuming Razorpay as the payment method
                'wallet' => $request->wallet ?? null,
                'bank' => $request->bank ?? null,
                'payment_date' => now(),
                'payment_vpa' => $request->payment_vpa ?? null,
                'ip_address' => $request->ip() ?? null,
                'international_payment' => $request->international_payment ?? null,
                'error_reason' => $request->error_reason ?? null,
                'error_code' => $request->error_code ?? null,
                'error_description' => $request->error_description ?? null,
                'payment_method' => 'razorpay'
            ]);
 
            // Optionally, update the order status
            $order = $payment->order;
            $order->update([
                'status' => 'completed',
                'payment_status' => 'paid'
            ]);
 
            return response()->json([
                'status' => true,
                'message' => 'Payment verified and completed',
                'order_number' => $order->order_number // You can return the order number or any other useful info
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Payment verification failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
 
 
 
}
 