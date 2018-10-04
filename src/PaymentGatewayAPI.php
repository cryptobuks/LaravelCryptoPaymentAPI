<?php

namespace Omnitask\CryptoPaymentAPI;

use Exception;
use Log;

class PaymentGatewayAPIResponse {
    public $success;
    public $httpStatus;
    public $responseBody;
    public $code;
    public $message;

    public function __construct($success, $httpStatus, $responseBody, $message = "") {
        $this->success = $success;
        $this->httpStatus = $httpStatus;
        $this->responseBody = $responseBody;
        $this->message = $message;
    }
}

class PaymentGatewayAPI
{
    protected $apiScheme;
    protected $apiUrl;

    public function __construct() {
        $this->apiScheme = config('cryptopaymentapi.payment-gateway-api-scheme');
        $this->apiUrl = config('cryptopaymentapi.payment-gateway-api-url');
    }
    
    
    public function initiatePayment($amount, $currency, $order_id, $is_demo) {
        $url = "";
        Log::info('PaymentGatewayAPI initiatePayment ' . $currency.$amount .' Order ID #'.$order_id);
        
        $token =  config('cryptopaymentapi.api-key');
        $secret_key =  config('cryptopaymentapi.api-secret');
        $digest_calculated = $amount . $currency . $order_id . $secret_key . $token;
        $digest_hash = hash("sha256", $digest_calculated);
        Log::info('PaymentGatewayAPI token ' . $token);

        $data['token'] = $token;
        $data['amount'] = $amount;
        $data['currency'] = $currency;
        $data['order_number'] = $order_id;
        $data['is_demo'] = $is_demo;
        $data['ok_url'] =  url(config('cryptopaymentapi.ok-url'));
        $data['fail_url'] =  url(config('cryptopaymentapi.fail-url'));
        $data['confirm_url'] =  url(config('cryptopaymentapi.confirm-url'));
        $data['digest'] = $digest_hash;

        $body = '<form id="redirect-form" action="'.$this->constructFullUrl('', false).'" method="POST">';
        $body .= 'Redirecting to crypto payment gateway...<input type="hidden" value="'.$token.'" name="token">';
        foreach($data as $key => $val){
            $body .= '<input type="hidden" value="'.$val.'" name="'.$key.'">';
        }
        $body .='</form>';
        $body .='<script>document.getElementById("redirect-form").submit();</script>';
        return $body;
     }

    private function constructFullUrl($url, $params) {
        $fullUrl =  $this->apiScheme . "://" . $this->apiUrl . '/'  . $url;

        Log::info('PaymentGatewayAPI request url: ' . print_r($fullUrl, true));
        return $fullUrl;
    }

  
}