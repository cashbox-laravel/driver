<?php

namespace LaravelCashierProvider\Driver\BankName\Technology;

use Helldar\Cashier\Services\Driver as BaseDriver;
use Helldar\Contracts\Cashier\Http\Response;
use LaravelCashierProvider\Driver\BankName\Technology\Exceptions\Manager;
use LaravelCashierProvider\Driver\BankName\Technology\Helpers\Statuses;
use LaravelCashierProvider\Driver\BankName\Technology\Requests\Cancel;
use LaravelCashierProvider\Driver\BankName\Technology\Requests\GetState;
use LaravelCashierProvider\Driver\BankName\Technology\Requests\Init;
use LaravelCashierProvider\Driver\BankName\Technology\Resources\Details;
use LaravelCashierProvider\Driver\BankName\Technology\Responses\Created;
use LaravelCashierProvider\Driver\BankName\Technology\Responses\Refund;
use LaravelCashierProvider\Driver\BankName\Technology\Responses\State;

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
