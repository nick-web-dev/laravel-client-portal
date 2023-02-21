<?php

namespace App\Dto\Owd\SalesOrderDash;

class TodaysOrders
{
    public int $posted;
    public int $completed;
    public int $fulfillmentStatusPercent;

    public static function fromJson(array $data): self
    {
        $instance = new self();
        $instance->posted = $data['posted'];
        $instance->completed = $data['completed'];
        $instance->fulfillmentStatusPercent = $data['fulfillmentStatusPercent'];
        return $instance;
    }
}
