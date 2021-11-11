<?php

namespace App\Dto;

class DashBoardOrders
{
    public $total;
    public $onHold;
    public $status;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->total = $data['total'] ?? 0;
        $instance->onHold = $data['onHold'] ?? 0;
        $instance->status = $data['status'] ?? 0;

        return $instance;
    }
}
