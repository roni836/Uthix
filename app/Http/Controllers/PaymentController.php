<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function phonePe()
    {
        $data = array(
            "merchantId" => "PGTESTPAYUAT",
            "merchantTransactionId" => "MT7850590068188104",
            "merchantUserId" => "MUID123",
            "amount" => 10000,
            "redirectUrl" => "https://webhook.site/redirect-url",
            "redirectMode" => "REDIRECT",
            "callbackUrl" => "https://webhook.site/callback-url",
            "mobileNumber" => "9999999999",
            "paymentInstrument" => array(
                "type" => "PAY_PAGE"
            ),
        );
        $encode = base64_encode(json_encode($data));
        $saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
        $saltIndex = 1;
        $string = $encode.'/pg/v1/pay'.$saltKey;
        $sha256 = hash('sha256',$string);
        $finalXHeader = $sha256.'###'.$saltIndex;
        $response =Curl::to('https://api-preprond.phonepe.com/apis/merchant-simulator/pg/v1/pay')
        ->withHeader('Content-Type:application/json')
        ->withHeader('X-VERFIY'.$finalXHeader)
        ->withHeader(json_encode(['request'=>$encode]))
        ->post();
        dd($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function response(Request $request)
    {
        $input = $request->all();
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
