<?php

namespace App\Dto;

class AsnInventoryDashboard
{
    public Asn $asn;
    public Inventory $inventory;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->asn = Asn::fromArray($data['asn'] ?? []);
        $instance->inventory = Inventory::fromArray($data['inventory'] ?? []);

        return $instance;
    }
}
