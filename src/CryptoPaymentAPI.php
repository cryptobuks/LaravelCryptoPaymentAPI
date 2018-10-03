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
   public function initiatePayment($amount, $currency, $order_id){
        $pgApi = new PaymentGatewayAPI();
        $result = $pgApi->initiatePayment($amount, $currency, $order_id);

        if($result['status'] == 200){
             
            return new CryptoPaymentAPIResponse(true, 200,  $result['body'], 'Crypto payment gateway window successfully fetched.');
        } else {
            $message = 'Failed to get crypto payment gateway window.';
             
            return new CryptoPaymentAPIResponse(false, 500, [], $message);
        }
   }
}