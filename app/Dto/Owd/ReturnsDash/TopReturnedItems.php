<?php

namespace App\Dto\Owd\ReturnsDash;

use App\Dto\Owd\SalesOrderDash\TopSellingItems;

class TopReturnedItems
{
    public int $productId;
    public int $soldQuantity;
    public int $returnRank;
    public int $sku;
    public string $name;

    public static function fromJson(array $data): self
    {
        $instance = new self();
        $instance->productId = $data['productId'];
        $instance->soldQuantity = $data['soldQuantity'];
        $instance->returnRank = $data['returnRank'];
        $instance->sku = $data['sku'];
        $instance->name = $data['name'];
        return $instance;
    }
}
