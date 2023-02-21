<?php

namespace App\Dto\Owd\SalesOrderDash;

class TopSellingItems
{
    public int $productId;
    public int $soldQuantity;
    public int $soldRank;
    public int $sku;
    public string $name;

    public static function fromJson(array $data): self
    {
        $instance = new self();
        $instance->productId = $data['productId'];
        $instance->soldQuantity = $data['soldQuantity'];
        $instance->soldRank = $data['soldRank'];
        $instance->sku = $data['sku'];
        $instance->name = $data['name'];
        return $instance;
    }
}
