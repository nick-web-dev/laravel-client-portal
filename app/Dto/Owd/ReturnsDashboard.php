<?php

namespace App\Dto\Owd;

use App\Dto\Owd\ReturnsDash\ReturnedOrders;
use App\Dto\Owd\ReturnsDash\TopReturnedItems;
class ReturnsDashboard
{
    /** @var ReturnedOrders[] */
    public array $returnedOrders;
    public int $averageReturns;
    public int $averageUnitsReturned;
    /** @var ReturnedUnits[] */
    public array $returnedUnits;
    /** @var TopReturnedItems[] */
    public array $topReturnedItems;

    public static function fromJson(array $data): self
    {
        $instance = new self();
        $instance->returnedOrders = array_map(static function($data) {
            return ReturnedOrders::fromJson($data);
        }, $data['returnedOrders']);
        $instance->averageReturns = $data['averageReturns'];
        $instance->averageUnitsReturned = $data['averageUnitsReturned'];
        $instance->returnedUnits = array_map(static function($data) {
            return ReturnedOrders::fromJson($data);
        }, $data['returnedUnits']);
        $instance->topReturnedItems = array_map(static function($data) {
            return TopReturnedItems::fromJson($data);
        }, $data['topReturnedItems']);
        return $instance;
    }
}
