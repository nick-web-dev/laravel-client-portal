<?php

namespace App\Dto\Owd\SalesOrderDash;

class ShipMethod
{
    public string $date;
    /** @var Methods[]|null */
    public ?array $methods;

    public static function fromJson(array $data): self
    {
        $instance = new self();
        $instance->date = $data['date'];
        $instance->methods = ($data['methods'] ?? null) !== null ? array_map(static function($data) {
            return ShippedOrdersChannels::fromJson($data);
        }, $data['methods']) : null;
        return $instance;
    }
}
