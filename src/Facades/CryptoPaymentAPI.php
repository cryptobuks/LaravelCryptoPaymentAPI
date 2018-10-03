<?php

namespace Omnitask\CryptoPaymentAPI\Facades;

use Illuminate\Support\Facades\Facade;

class CryptoPaymentAPI extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cryptopaymentapi';
    }
}
