<?php

namespace App\Dto;

class SalesOrdersShippedOrder
{
    public $date;
    /**@var SalesOrdersShippedOrdersByChannel[] $channels */
    public array $channels;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->date = $data['date'];
        $instance->channels = [];
        $ordersByChannels = $data['channels'] ?? [];
        foreach ($ordersByChannels as $ordersByChannel) {
            $instance->channels[] = SalesOrdersShippedOrdersByChannel::fromArray($ordersByChannel);
        }
        return $instance;
    }
}
