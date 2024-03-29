<?php

return [
    /*
     * Set the  API KEYS & fail/confirm URL's from the .env file, or set it here.
     */
    'api-key' => env('PAYMENT_GATEWAY_API_KEY', null),
    'api-secret' => env('PAYMENT_GATEWAY_API_SECRET', null),
    'payment-gateway-api-url' => env('PAYMENT_GATEWAY_API_URL', 'form.migpayments.com'),
    'payment-gateway-api-scheme' => env('PAYMENT_GATEWAY_API_SCHEME', 'https'),
    'ok-url' => env('PAYMENT_GATEWAY_API_OK_URL', ''),
    'fail-url' => env('PAYMENT_GATEWAY_API_FAIL_URL', ''),
    'confirm-url' => env('PAYMENT_GATEWAY_API_CONFIRM_URL', ''),
    'partial-url' => env('PAYMENT_GATEWAY_API_CONFIRM_PARTIAL_URL', ''),
];