<?php

declare(strict_types=1);

namespace YourName\CashierDriver\BankName\Technology\Requests;

use Helldar\Cashier\Facades\Config\Main;
use Helldar\Cashier\Http\Request;
use YourName\CashierDriver\BankName\Auth\Auth;

abstract class BaseRequest extends Request
{
    protected $production_host = 'https://api-bank-uri.com';

    protected $dev_host = 'https://dev.api-bank-uri.com';

    protected $auth = Auth::class;

    public function getRawHeaders(): array
    {
        return [
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    public function getHttpOptions(): array
    {
        if (Main::isProduction()) {
            return [
                'cert' => [
                    $this->model->getCertificatePath(),
                    $this->model->getCertificatePassword(),
                ],
            ];
        }

        return [];
    }
}
