<?php

namespace App\Dto;

class AccountDashBoard
{
    public DashBoardFulfillment $fulfillment;
    public DashBoardOrders $orders;
    public DashBoardAsnReceives $asnReceives;
    public DashBoardInventory $inventory;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->fulfillment = DashBoardFulfillment::fromArray($data['fulfillment'] ?? []);
        $instance->orders = DashBoardOrders::fromArray($data['orders'] ?? []);
        $instance->asnReceives = DashBoardAsnReceives::fromArray($data['asn_receives'] ?? []);
        $instance->inventory = DashBoardInventory::fromArray($data['inventory'] ?? []);

        return $instance;
    }
}
