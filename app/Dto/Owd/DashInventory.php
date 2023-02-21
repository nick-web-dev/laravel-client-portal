<?php
namespace App\Dto\Owd;

class DashInventory
{
    public $outOfStock;
    public $lowInventory;


    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->outOfStock = $data['outOfStock'] ?? 0;
        $instance->lowInventory = $data['lowInventory'] ?? 0;

        return $instance;
    }

}
