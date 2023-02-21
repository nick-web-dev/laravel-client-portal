<?php
namespace App\Dto\Owd;

use App\Dto\Owd\SalesOrderDash\OrdersByShipMethod;
use App\Dto\Owd\SalesOrderDash\TopSellingItems;
use App\Dto\Owd\SalesOrderDash\ShippedOrdersByChannel;
use App\Dto\Owd\SalesOrderDash\SalesOrderShippedOrders;
use App\Dto\Owd\SalesOrderDash\TodaysOrders;

class SalesOrderDashboard{
    public TodaysOrders $todaysOrders;
    public SalesOrderShippedOrders $shippedOrders;
    public ShippedOrdersByChannel $shippedOrdersByChannel;
    public array $topSellingItems;
    public OrdersByShipMethod $ordersByShipMethod;

    public static function fromJson(array $data): self
    {
        $instance = new self();
        $instance->todaysOrders = TodaysOrders::fromJson($data['todaysOrders']);
        $instance->shippedOrders = SalesOrderShippedOrders::fromJson($data['shippedOrders'] ?? []);
        $instance->shippedOrdersByChannel = ShippedOrdersByChannel::fromJson($data['shippedOrdersByChannel'][0] ?? []);
        $instance->topSellingItems = array_map(static function($data) {
            return TopSellingItems::fromJson($data);
        }, $data['topSellingItems']);
        $instance->ordersByShipMethod = OrdersByShipMethod::fromJson($data['ordersByShipMethod'] ?? []);
        return $instance;
    }
}
