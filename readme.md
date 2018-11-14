# MigPayments Gateway API

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]


## Installation

Package works with Laravel 5+. You can add it to your composer.json file with:

``` bash
"omnitask/cryptopaymentapi": "dev-master"
```

## Configuration
For config use .env file

``` bash
PAYMENT_GATEWAY_API_OK_URL= // Data { order_number, crypto_currency }
PAYMENT_GATEWAY_API_FAIL_URL= //Data { order_number }
PAYMENT_GATEWAY_API_CONFIRM_URL= //Data { order_number, crypto_currency, transaction_id, price, order_percentage, hash_digest  }
PAYMENT_GATEWAY_API_CONFIRM_PARTIAL_URL= //Data { order_number, crypto_currency, transaction_id, price, order_percentage, hash_digest  }
PAYMENT_GATEWAY_API_KEY=
PAYMENT_GATEWAY_API_SECRET=
```
or publish config/cryptopaymentapi.php

``` bash
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
```
## Usage example
``` bash
 $cryptoPaymentAPI = new CryptoPaymentAPI();
 // Parameters for initiatePayment(total, currency, order_id, is_demo)
 $result = $cryptoPaymentAPI->initiatePayment($order->total, 'EUR', $order->id, 'yes');
 return $result; // Redirect to payment gateway window
```
Confirming order ("confirm-url" callback) example
``` bash
 public function confirmOrder(Reqeuest $request){
    $input = $request->input();
    
    $order = Order::find($input['order_number']);
    
    $order->status = 1;
    $order->price = $input['price']
    $order->transaction_id = $input['transaction_id'];
    $order->crypto_currency = $input['crypto_currency'];
    $order->order_percentage =  $input['order_percentage'];
    $order->save();
 }
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

Omnitask

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/omnitask/cryptopaymentapi.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/omnitask/cryptopaymentapi.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/omnitask/cryptopaymentapi/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/omnitask/cryptopaymentapi
[link-downloads]: https://packagist.org/packages/omnitask/cryptopaymentapi
[link-travis]: https://travis-ci.org/omnitask/cryptopaymentapi
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/omnitask
[link-contributors]: ../../contributors]
