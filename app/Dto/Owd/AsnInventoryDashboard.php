<?php

namespace App\Dto\Owd;

use App\Dto\Owd\AsnInventoryDash\AsnDashboard;
use App\Dto\Owd\AsnInventoryDash\InventoryDashboard;

class AsnInventoryDashboard
{
    public AsnDashboard $asn;
    public InventoryDashboard $inventory;

    public static function fromJson(array $data): self
    {
        $instance = new self();
        $instance->asn = AsnDashboard::fromJson($data['asn'] ?? []);
        $instance->inventory = InventoryDashboard::fromJson($data['inventory'] ?? []);

        return $instance;
    }
}
