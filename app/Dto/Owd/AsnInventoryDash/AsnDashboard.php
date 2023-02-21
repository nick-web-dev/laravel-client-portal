<?php

namespace App\Dto\Owd\AsnInventoryDash;

class AsnDashboard
{
    public string $updatedAt;
    public int $pendingCount;
    public int $arrivedCount;
    public int $inProcessCount;
    public int $nonConformingCount;

    public static function fromJson(array $data): self
    {
        $instance = new self();
        $instance->updatedAt = $data['updatedAt'] ?? '';
        $instance->pendingCount = $data['pendingCount'] ?? 0;
        $instance->arrivedCount = $data['arrivedCount'] ?? 0;
        $instance->nonConformingCount = $data['nonConformingCount'] ?? 0;
        $instance->inProcessCount = $data['inProcessCount'] ?? 0;

        return $instance;
    }
}
