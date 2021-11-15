<?php

namespace App\Dto;

class SalesOrdersDashboard
{
    public SalesOrdersTodaySummary $todaySummary;
    public SalesOrdersDashboardShippedOrders $shippedOrders;
    public SalesOrdersByChannel $ordersByChannel;
    /** @var SalesOrdersTopSellingItem[] $topSellingItems */
    public array $topSellingItems;
    /** @var SalesDashboardOrdersByShipMethod[] $ordersByShipMethod */
    public array $ordersByShipMethod;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->todaySummary = SalesOrdersTodaySummary::fromArray($data['todaySummary'] ?? []);
        $instance->shippedOrders = SalesOrdersDashboardShippedOrders::fromArray($data['shippedOrders'] ?? []);
        $ordersByChannel = $data['ordersByChannel'][0] ?? []; //@todo
        $instance->ordersByChannel = SalesOrdersByChannel::fromArray($ordersByChannel);
        $topSellingItems = $data['topSellingItems'] ?? [];
        foreach ($topSellingItems as $topSellingItem) {
            $instance->topSellingItems[] = SalesOrdersTopSellingItem::fromArray($topSellingItem);
        }
        $allOrdersByShipMethod = $data['ordersByShipMethod'] ?? [];
        foreach ($allOrdersByShipMethod as $ordersByShipMethod) {
            $instance->ordersByShipMethod[] = SalesDashboardOrdersByShipMethod::fromArray($ordersByShipMethod);
        }
        return $instance;
    }
}
