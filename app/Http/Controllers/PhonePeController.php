<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PhonePeService;

class PhonePeController extends Controller
{
    protected $phonePeService;

    public function __construct(PhonePeService $phonePeService)
    {
        $this->phonePeService = $phonePeService;
    }

    /**
     * Initiate Payment
     */
    public function initiatePayment(Request $request)
    {
        $request->validate([
            'mobile_number' => 'required',
            'merchant_user_id' => 'required',
            'amount' => 'required|numeric|min:1',
        ]);

        $transactionId = "TXN" . time();
        $callbackUrl = route('phonepe.callback');
        $redirectUrl = route('phonepe.success');

        $response = $this->phonePeService->initiatePayment(
            $request->mobile_number,
            $request->merchant_user_id,
            $request->amount * 100, // Convert to paise
            $transactionId,
            $callbackUrl,
            $redirectUrl
        );

        return response()->json(['url' => $response->getInstrumentResponse()->getRedirectInfo()->getUrl()]);
    }

    /**
     * Callback URL for Payment Verification
     */
    public function paymentCallback(Request $request)
    {
        $isValid = $this->phonePeService->verifyCallback($request->input('response'), $request->header('x-verify'));

        if ($isValid) {
            return response()->json(['message' => 'Payment verified successfully.']);
        }

        return response()->json(['message' => 'Payment verification failed.'], 400);
    }

    /**
     * Check Transaction Status
     */
    public function checkStatus(Request $request)
    {
        $request->validate(['transaction_id' => 'required']);
        return response()->json($this->phonePeService->checkTransactionStatus($request->transaction_id));
    }

    /**
     * Process Refund
     */
    public function refund(Request $request)
    {
        $request->validate([
            'original_transaction_id' => 'required',
            'merchant_transaction_id' => 'required',
            'amount' => 'required|numeric|min:1',
        ]);

        return response()->json(
            $this->phonePeService->processRefund(
                $request->original_transaction_id,
                $request->merchant_transaction_id,
                $request->amount * 100,
                route('phonepe.callback')
            )
        );
    }
}
