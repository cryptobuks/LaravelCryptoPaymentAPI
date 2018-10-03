<?php

namespace Omnitask\CryptoPaymentAPI;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use Ramsey\Uuid\Uuid;
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
        $this->apiScheme = config('payment-gateway-api-scheme');
        $this->apiUrl = config('payment-gateway-api-key');
    }
    
    
    public function initiatePayment($amount, $currency, $order_id) {
        $url = "/";
        Log::info('PaymentGatewayAPI initiatePayment ' . $amount. ' :'.$currency.''.$order_id);
        $data['token'] = config('api-key');
        $data['amount'] = $amount;
        $data['currency'] = $currency;
        $data['order_number'] = $order_id;
        $data['is_demo'] = $is_demo;
        $data['ok_url'] =  config('ok-url');
        $data['fail_url'] =  config('fail-url');
        $data['confirm_url'] =  config('confirm-url');

        $user  = $payment->user;
        $hash = $payment->amount . $payment->id . $payment->shopPlugin->api_secret;
        $data['hash'] = $hash;
         
        $result = $this->execute($url, [], $data, "post");
        Log::info('PaymentGatewayAPI paymentConfirmed response: ' . print_r($result, true));
        return $this->processResult($result, null, "Failed to register user to PaymentGatewayAPI");
    }

    private function constructFullUrl($url, $params) {
        $fullUrl =  $this->apiScheme . "://" . $this->apiUrl . '/'  . $url;

        Log::info('PaymentGatewayAPI request url: ' . print_r($fullUrl, true));
        return $fullUrl;
    }

    private function execute($url, $headers, $data, $requestType = 'post')
    {
        Log::info('PaymentGatewayAPI try: ' . $url);
        $headers['CONTENT_TYPE'] = 'application/json';
        $httpClient = new Client(['headers' => $headers, 'verify' => false]);
      
        if ($requestType == 'get') {
            $params = '?';
            foreach ($data as $key => $obj) {
                $params .= $key . '=' . $obj;
                if ($obj !== end($data)) {
                    $params .= '&';
                }
            }
            $request = $httpClient->get($this->constructFullUrl($url, $params), [
                'http_errors' => false
            ]);
        } else {
            try {
                $request = $httpClient->request('POST', $this->constructFullUrl($url, false), ['json' => $data,  'http_errors' => false]);
 
                $result = [
                    'status' => $request->getStatusCode(),
                    'body' => json_decode($request->getBody()->getContents(), true)
                ];
                

            } catch (\Exception   $e) {
                Log::info('PaymentGatewayAPI network error', ['result' => $e]);
                $result = [
                    'status' => 504,
                    'body' => 'Error while connecting to PaymentGatewayAPI.'
                ];
                return $result;
            }
        }

        Log::info('PaymentGatewayAPI: ', ['data' => $data]);
        Log::info('PaymentGatewayAPI request: ' . print_r($request, true));
        $result = [
            'status' => $request->getStatusCode(),
            'body' => json_decode($request->getBody(), true)
        ];

        return $result;
    }

    private function processResult($result, $successMessage = null, $errorMessage = null)
    {
        Log::info('resuu', ['result' => $result] );
        $status = intval($result["status"]);
        $body = $result['body'];
        Log::info('processResult', ['body' => $body]);
        if ($status == 200 || $status == 201) {
            $response = [
                'status' => 200,
                'body' => $body,
            ];

            if ($successMessage)
                Log::info($successMessage, (array)$body);
        } else {
            Log::error('Result status: '.$status.'. PaymentGatewayAPI Error message: ' . $errorMessage);

            if($status == 400){
                $message = $result['body']['message'];
                Log::error('PaymentGatewayAPI Validation Error, message: ' . $message);
            } else {
                $status = 500;
                $message = 'Failed to get response from PaymentGatewayAPI.';
            }
            
            
            $response = [
                'status' => $status,
                'body' => ['error' => $message]
            ];
        }

        return $response;
    }
}