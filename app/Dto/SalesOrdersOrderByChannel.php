<?php

namespace App\Dto;

class SalesOrdersOrderByChannel
{
    public string $channelName;
    public int $total;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->channelName = $data['channelName'] ?? 'Undefined';
        $instance->total = (int)($data['total'] ?? 0);
        return $instance;
    }
}
