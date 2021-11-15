<?php

namespace App\Dto;

class SalesOrdersTopSellingItem
{
    public string $productId;
    public $soldQuantity;
    public $soldRank;
    public string $number;
    public string $name;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->productId = $data['productId'] ?? '';
        $instance->soldQuantity = $data['soldQuantity'] ?? 0;
        $instance->soldRank = $data['soldRank'] ?? 0;
        $instance->number = $data['number'] ?? '';
        $instance->name = $data['name'] ?? '';
        return $instance;
    }
}
