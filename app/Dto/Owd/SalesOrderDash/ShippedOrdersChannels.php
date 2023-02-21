<?php

namespace App\Dto\Owd\SalesOrderDash;

class ShippedOrdersChannels
{
    public ?string $name;
    public ?int $total;

    public static function fromJson(array $data): self
    {
        $instance = new self();
        $instance->name = $data['name'] ?? null;
        $instance->total = $data['total'] ?? null;
        return $instance;
    }
}
