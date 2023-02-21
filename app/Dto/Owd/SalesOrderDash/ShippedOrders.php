<?php

namespace App\Dto\Owd\SalesOrderDash;
use App\Dto\Owd\SalesOrderDash\ShippedOrdersChannels;

class ShippedOrders
{
    public ?string $date;
    /** @var Channels[]|null */
    public ?array $channels;

    public static function fromJson(array $data): self
    {
        $instance = new self();
        $instance->date = $data['date'] ?? null;
        $instance->channels = ($data['channels'] ?? null) !== null ? array_map(static function($data) {
            return ShippedOrdersChannels::fromJson($data);
        }, $data['channels']) : null;
        return $instance;
    }
}
