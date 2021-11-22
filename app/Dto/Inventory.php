<?php

namespace App\Dto;

class Inventory
{
    public string $updatedAt;
    public int $lowStockProductCount;
    public int $outOfStockProductCount;
    public int $damagedProductCount;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->updatedAt = $data['updatedAt'] ?? '';
        $instance->lowStockProductCount = $data['lowStockProductCount'] ?? 0;
        $instance->outOfStockProductCount = $data['outOfStockProductCount'] ?? 0;
        $instance->damagedProductCount = $data['damagedProductCount'] ?? 0;

        return $instance;
    }
}
