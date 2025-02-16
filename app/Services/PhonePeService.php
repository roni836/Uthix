<?php

namespace App\Services;

use PhonePe\PhonePePaymentClient;
use PhonePe\Enum\Env;
use PhonePe\Builder\PgPayRequestBuilder;
use PhonePe\Builder\InstrumentBuilder;

class PhonePeService
{
    protected $client;

    public function __construct()
    {
        $env = config('phonepe.environment') === 'PRODUCTION' ? Env::PRODUCTION : Env::UAT;

        $this->client = new PhonePePaymentClient(
            config('phonepe.merchant_id'),
            config('phonepe.salt_key'),
            config('phonepe.salt_index'),
            $env,
            true
        );
    }

    /**
     * Initiate Payment
     */
    public function initiatePayment($mobileNumber, $merchantUserId, $amount, $transactionId, $callbackUrl, $redirectUrl)
    {
        $request = PgPayRequestBuilder::builder()
            ->mobileNumber($mobileNumber)
            ->callbackUrl($callbackUrl)
            ->merchantId(config('phonepe.merchant_id'))
            ->merchantUserId($merchantUserId)
            ->amount($amount)
            ->merchantTransactionId($transactionId)
            ->redirectUrl($redirectUrl)
            ->redirectMode("REDIRECT")
            ->paymentInstrument(InstrumentBuilder::buildPayPageInstrument())
            ->build();

        return $this->client->pay($request);
    }

    /**
     * Check Transaction Status
     */
    public function checkTransactionStatus($transactionId)
    {
        return $this->client->statusCheck($transactionId);
    }

    /**
     * Process Refund
     */
    public function processRefund($originalTransactionId, $merchantTransactionId, $amount, $callbackUrl)
    {
        $pgRefundRequest = PgRefundRequestBuilder::builder()
            ->originalTransactionId($originalTransactionId)
            ->merchantId(config('phonepe.merchant_id'))
            ->merchantTransactionId($merchantTransactionId)
            ->callbackUrl($callbackUrl)
            ->amount($amount)
            ->build();

        return $this->client->refund($pgRefundRequest);
    }

    /**
     * Verify Callback Signature
     */
    public function verifyCallback($response, $xVerify)
    {
        return $this->client->verifyCallback($response, $xVerify);
    }
}
