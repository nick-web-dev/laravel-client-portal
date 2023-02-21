<?php

namespace App\Dto\Owd;

class DashTodaysOrders{
    public $total;
    public $onHold;
    public $fulfilmentStatusPercent;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->total = $data['total'] ?? 0;
        $instance->onHold = $data['onHold'] ?? 0;
        $instance->fulfilmentStatusPercent = $data['fulfilmentStatusPercent'] ?? 0;

        return $instance;
    }

}
