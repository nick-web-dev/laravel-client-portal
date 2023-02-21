<?php

namespace App\Dto\Owd\ReturnsDash;

use App\Dto\Owd\SalesOrderDash\ShippedOrdersChannels;

class ReturnedOrders
{
    public string $date;
    /** @var Channels[] */
    public array $channels;

    public static function fromJson(array $data): self
    {
        $instance = new self();
        $instance->date = $data['date'];
        $instance->channels = array_map(static function($data) {
            return ShippedOrdersChannels::fromJson($data);
        }, $data['channels']);
        return $instance;
    }
}
