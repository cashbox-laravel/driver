<?php

declare(strict_types=1);

namespace YourName\CashierDriver\BankName\Technology\Requests;

class GetState extends BaseRequest
{
    protected $path = '/api/status';

    public function getRawBody(): array
    {
        return [
            'PaymentId' => $this->model->getExternalId(),
        ];
    }
}
