<?php

declare(strict_types=1);

namespace LaravelCashierProvider\Driver\BankName\Technology\Responses;

use Helldar\Cashier\Http\Response;

class Refund extends Response
{
    protected $map = [
        self::KEY_EXTERNAL_ID => 'PaymentId',

        self::KEY_STATUS => 'Status',
    ];
}
