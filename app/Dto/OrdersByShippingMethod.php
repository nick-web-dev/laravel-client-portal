<?php

namespace App\Dto;

class OrdersByShippingMethod
{
    public string $name;
    public int $total;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->name = $data['name'] ?? 'Undefined';
        $instance->total = (int)($data['total'] ?? 0);
        return $instance;
    }
}
