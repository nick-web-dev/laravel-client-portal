<?php

namespace App\Dto;

class SalesDashboardOrdersByShipMethod
{
    public string $date;
    /** @var OrdersByShippingMethod[] $methods */
    public array $methods;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->date = $data['date'] ?? '';
        $methods = $data['methods'] ?? [];
        foreach ($methods as $method) {
            $instance->methods[] = OrdersByShippingMethod::fromArray($method);
        }
        return $instance;
    }
}
