<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MpesaTransaction;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class MPESAController extends Controller
{
    public function generateAccessToken()
    {
        $consumer_key="8aRqSGnRaCiBnsqTnsE8yAxdxIEMayCy";
        $consumer_secret="7kR2aeMT6dbnT5VY";
        $credentials = base64_encode($consumer_key.":".$consumer_secret);

        $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer '. base64_encode("$consumer_key:$consumer_secret")
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        dd($curl_response);
        $access_token=json_decode($curl_response);
        dd($access_token);
        // return $access_token->access_token;
    }

    public function mpesaRegisterUrls()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://sandbox.safaricom.co.ke/mpesa/c2b/v2/registerurl');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization: Bearer '. $this->generateAccessToken()));

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array(
            'ShortCode' => "600982",
            'ResponseType' => 'Completed',
            'ConfirmationURL' => "https://dinenstayapi.amosbilly.co.ke/public/api/v1/transaction/confirmation",
            'ValidationURL' => "https://dinenstayapi.amosbilly.co.ke/api/v1/validation"
        )));
        $curl_response = curl_exec($curl);
        echo $curl_response;
    }

    public function mpesaConfirmation(Request $request)
    {
        $content=json_decode($request->getContent());
        Log::info($request->getContent());

        $mpesa_transaction = new MpesaTransaction();
        $mpesa_transaction->TransactionType = $content->TransactionType;
        $mpesa_transaction->TransID = $content->TransID;
        $mpesa_transaction->TransTime = $content->TransTime;
        $mpesa_transaction->TransAmount = $content->TransAmount;
        $mpesa_transaction->BusinessShortCode = $content->BusinessShortCode;
        $mpesa_transaction->BillRefNumber = $content->BillRefNumber;
        $mpesa_transaction->InvoiceNumber = $content->InvoiceNumber;
        $mpesa_transaction->OrgAccountBalance = $content->OrgAccountBalance;
        $mpesa_transaction->ThirdPartyTransID = $content->ThirdPartyTransID;
        $mpesa_transaction->MSISDN = $content->MSISDN;
        $mpesa_transaction->FirstName = $content->FirstName;
        $mpesa_transaction->MiddleName = "**";
        $mpesa_transaction->LastName = "**";
        $mpesa_transaction->save();

        // Responding to the confirmation request
        $response = new Response;
        $response->headers->set("Content-Type","text/xml; charset=utf-8");
        $response->setContent(json_encode(["C2BPaymentConfirmationResult"=>"Success"]));
        return $response;
    }

    public function mpesaValidation(Request $request)
    {
        $result_code = "0";
        $result_description = "Accepted validation request.";
        return $this->createValidationResponse($result_code, $result_description);
    }
}
