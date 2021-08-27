<?php

namespace YourName\CashierDriver\BankName\Technology;

use Helldar\Cashier\Facades\Helpers\Model;
use Helldar\Cashier\Services\Driver as BaseDriver;
use Helldar\Contracts\Cashier\Http\Response;
use YourName\CashierDriver\BankName\Technology\Exceptions\Manager;
use YourName\CashierDriver\BankName\Technology\Helpers\Statuses;
use YourName\CashierDriver\BankName\Technology\Requests\Cancel;
use YourName\CashierDriver\BankName\Technology\Requests\GetState;
use YourName\CashierDriver\BankName\Technology\Requests\Init;
use YourName\CashierDriver\BankName\Technology\Resources\Details;
use YourName\CashierDriver\BankName\Technology\Responses\Created;
use YourName\CashierDriver\BankName\Technology\Responses\Refund;
use YourName\CashierDriver\BankName\Technology\Responses\State;

class Driver extends BaseDriver
{
    protected $exceptions = Manager::class;

    protected $statuses = Statuses::class;

    protected $details = Details::class;

    public function start(): Response
    {
        $request = Init::make($this->model);

        return $this->request($request, Created::class);
    }

    public function check(): Response
    {
        $request = GetState::make($this->model);

        return $this->request($request, State::class);
    }

    public function refund(): Response
    {
        $request = Cancel::make($this->model);

        return $this->request($request, Refund::class);
    }
}
