<?php

return [
    /*
     * Set the  API KEYS & fail/confirm URL's from the .env file, or set it here.
     */
    'api-key' => env('API_KEY_TOKEN', null),
    'api-secret' => env('API_KEY_SECRET', null),
    'payment-gateway-api-key' => env('PAYMENT_GATEWAY_API_URL', 'orangegateway.demo.ba'),
    'payment-gateway-api-scheme' => env('PAYMENT_GATEWAY_API_SCHEME', 'http'),
    'ok-url' => env('PAYMENT_GATEWAY_API_OK_URL', ''),
    'fail-url' => env('PAYMENT_GATEWAY_API_FAIL_URL', ''),
    'confirm-url' => env('PAYMENT_GATEWAY_API_CONFIRM_URL', ''),
];