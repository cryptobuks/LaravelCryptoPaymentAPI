<?php

namespace Omnitask\CryptoPaymentAPI;

use App\CryptoAddress;
use App\Repositories\CryptoAddressRepository;
use App\AccountType;
use App\Payment;
use App\Repositories\PaymentGatewayAPI;

class PaymentGatewayServiceResponse {
    public $success;
    public $data;
    public $message;

    public function __construct($success, $data, $message = "") {
        $this->success = $success;
        $this->data = $data;
        $this->message = $message;
    }
}

class PaymentGatewayService
{
    public static function paymentConfirmedWebhook($payment) {
        
        $pg_api = new PaymentGatewayAPI();
        $result = $pg_api->paymentConfirmed($payment);
        if($result['status'] == 200){
             
            return new PaymentGatewayServiceResponse(true, $payment, "Payment gateway notified of payment completion.");
        } else {
            $message = "Failed to notify payment gateway for payment ID :". $payment->id. ', case ID :'. $payment->case_id;
            
            NotificationService::notifyAdmins($message, '/');
            return new PaymentGatewayServiceResponse(false, [], $message);
        }
      
    }
 
}