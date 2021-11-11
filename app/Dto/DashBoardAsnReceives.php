<?php

namespace App\Dto;

class DashBoardAsnReceives
{
    public $pending;
    public $arrived;
    public $inProcess;
    public $nonconforming;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->pending = $data['pending'] ?? 0;
        $instance->arrived = $data['arrived'] ?? 0;
        $instance->inProcess = $data['inProcess'] ?? 0;
        $instance->nonconforming = $data['nonconforming'] ?? 0;

        return $instance;
    }
}
