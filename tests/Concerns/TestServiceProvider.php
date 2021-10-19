<?php

declare(strict_types=1);

namespace Tests\Concerns;

use Helldar\Cashier\Providers\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    protected function bootMigrations(): void
    {
        $this->loadMigrationsFrom([
            __DIR__ . '/../database/migrations',
            __DIR__ . '/../../vendor/andrey-helldar/cashier/database/migrations/main',
        ]);
    }
}
