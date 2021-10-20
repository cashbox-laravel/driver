<?php

declare(strict_types=1);

namespace LaravelCashierProvider\Driver\BankName\Technology\Responses;

use Helldar\Cashier\Http\Response;

class State extends Response
{
    protected $map = [
        self::KEY_EXTERNAL_ID => 'PaymentId',

        self::KEY_STATUS => 'Status',
    ];

    public function isEmpty(): bool
    {
        return empty($this->getExternalId()) || empty($this->getStatus());
    }
}
