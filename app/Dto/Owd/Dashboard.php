<?php

namespace App\Dto\Owd;


class Dashboard
{
    public DashPromisesMet $dashPromisesMet;
    public DashTodaysOrders $dashTodaysOrders;
    public DashAsns $dashAsns;
    public DashReceives $dashReceives;
    public DashInventory $dashInventory;
    public $updatedAt;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->dashPromisesMet = DashPromisesMet::fromArray($data['promisesMet'] ?? []);
        $instance->dashTodaysOrders = DashTodaysOrders::fromArray($data['todaysOrders'] ?? []);
        $instance->dashAsns = DashAsns::fromArray($data['asns'] ?? []);
        $instance->dashReceives = DashReceives::fromArray($data['receives'] ?? []);
        $instance->dashInventory = DashInventory::fromArray($data['inventory'] ?? []);
        //$instance->updatedAt = $data['updatedAt'];

        return $instance;
    }
}
