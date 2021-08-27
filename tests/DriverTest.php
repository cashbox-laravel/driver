<?php

namespace Tests;

use Helldar\Cashier\Http\Response;
use Helldar\Contracts\Cashier\Driver as DriverContract;
use Helldar\Contracts\Cashier\Http\Response as ResponseContract;
use Helldar\Support\Facades\Http\Url;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Fixtures\Models\RequestPayment;
use YourName\CashierDriver\BankName\Technology\Driver as Technology;

class DriverTest extends TestCase
{
    use RefreshDatabase;

    protected $model = RequestPayment::class;

    protected function setUp(): void
    {
        parent::setUp();

        $this->runSeeders();
    }

    public function testStart()
    {
        $response = $this->driver()->start();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertInstanceOf(ResponseContract::class, $response);

        $this->assertIsString($response->getExternalId());
        $this->assertMatchesRegularExpression('/^(\d+)$/', $response->getExternalId());

        $this->assertNull($response->getStatus());

        $this->assertTrue(Url::is($response->getUrl()));
    }

    public function testCheck()
    {
        $this->driver()->start();

        $response = $this->driver()->check();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertInstanceOf(ResponseContract::class, $response);

        $this->assertIsString($response->getExternalId());
        $this->assertMatchesRegularExpression('/^(\d+)$/', $response->getExternalId());

        $this->assertSame('FORM_SHOWED', $response->getStatus());

        $this->assertSame([
            'status' => 'FORM_SHOWED',
        ], $response->toArray());
    }

    public function testRefund()
    {
        $this->driver()->start();

        $response = $this->driver()->refund();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertInstanceOf(ResponseContract::class, $response);

        $this->assertIsString($response->getExternalId());
        $this->assertMatchesRegularExpression('/^(\d+)$/', $response->getExternalId());

        $this->assertSame('CANCELED', $response->getStatus());
    }

    protected function driver(): DriverContract
    {
        $model = $this->payment();

        $config = $this->config();

        return Technology::make($config, $model);
    }

    protected function payment(): RequestPayment
    {
        return RequestPayment::firstOrFail();
    }
}
