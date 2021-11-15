<?php

namespace App\Dto;

class SalesOrdersByChannel
{
    public array $day = [];
    public array $month = [];
    public array $quarter = [];
    public array $year = [];

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $dayOrders = $data['day'] ?? [];
        foreach ($dayOrders as $dayOrder) {
            $instance->day[] = SalesOrdersOrderByChannel::fromArray($dayOrder);
        }
        $monthOrders = $data['month'] ?? [];
        foreach ($monthOrders as $monthOrder) {
            $instance->month[] = SalesOrdersOrderByChannel::fromArray($monthOrder);
        }
        $quarterOrders = $data['quarter'] ?? [];
        foreach ($quarterOrders as $quarterOrder) {
            $instance->quarter[] = SalesOrdersOrderByChannel::fromArray($quarterOrder);
        }
        $yearOrders = $data['year'] ?? [];
        foreach ($yearOrders as $yearOrder) {
            $instance->year[] = SalesOrdersOrderByChannel::fromArray($yearOrder);
        }

        return $instance;
    }
}
