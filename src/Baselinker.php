<?php

declare(strict_types=1);

namespace Core45\LaravelBaselinker;

use Core45\LaravelBaselinker\Baselinker\Catalog;
use Core45\LaravelBaselinker\Baselinker\ExternalStorage;
use Core45\LaravelBaselinker\Baselinker\Order;
use Core45\LaravelBaselinker\Baselinker\Shipment;

class Baselinker
{
    public function catalog(): Catalog
    {
        return new Catalog;
    }

    public function externalStorage(): ExternalStorage
    {
        return new ExternalStorage;
    }

    public function order(): Order
    {
        return new Order;
    }

    public function shipment(): Shipment
    {
        return new Shipment;
    }
}
