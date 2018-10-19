<?php

namespace Omnitask\CryptoPaymentAPI;
use Omnitask\CryptoPaymentAPI\PaymentGatewayAPI;

class CryptoPaymentAPIResponse {
    public $success;
    public $httpStatus;
    public $responseBody;
    public $message;

    public function __construct($success, $httpStatus, $responseBody, $message = '') {
        $this->success = $success;
        $this->httpStatus = $httpStatus;
        $this->responseBody = $responseBody;
        $this->message = $message;
    }
}
class CryptoPaymentAPI
{
   public function initiatePayment($amount, $currency, $order_id, $is_demo){
        $pgApi = new PaymentGatewayAPI();
        //amount * 100 conversion to cents
        $result = $pgApi->initiatePayment($amount * 100, $currency, $order_id, $is_demo);
        return $result;
   }
}