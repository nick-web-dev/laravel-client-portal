<?php

namespace App\Dto;

class DashBoardFulfillment
{
    public $percent;
    public $accuracy;
    public $savings;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->percent = $data['percent'] ?? 0;
        $instance->accuracy = $data['accuracy'] ?? 0;
        $instance->savings = $data['savings'] ?? 0;

        return $instance;
    }
}
