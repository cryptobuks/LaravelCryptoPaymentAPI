<?php

return [
    /*
     * Set the auth ID from the .env file, or set it here.
     */
    'api-key' => env('API_KEY_TOKEN', null),
    'api-secret' => env('API_KEY_SECRET', null),
    'payment-gateway-api-key' => env('PAYMENT_GATEWAY_API_URL', 'orangegateway.demo.ba'),
    'payment-gateway-api-scheme' => env('PAYMENT_GATEWAY_API_SCHEME', 'http'),
];