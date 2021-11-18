<?php

namespace App\Dto;

use Illuminate\Support\Carbon;

class SalesOrdersDashboardOrdersByShipMethod
{
    /** @var SalesOrdersByShipMethod[] $ordersByShipMethod */
    public array $ordersByShipMethod = [];
    public array $dataSource = [];
    public array $series = [];

    public static function fromArray(array $data): self
    {
        $instance = new self();
        foreach ($data as $ordersByShipMethod) {
            $instance->ordersByShipMethod[] = SalesOrdersByShipMethod::fromArray($ordersByShipMethod);
        }

        return $instance;
    }

    public function haveNoOrders(): bool
    {
        return empty($this->dataSource);
    }

    public function prepareDataSource(): void
    {
        $dataSource = collect($this->ordersByShipMethod);

        $series = $dataSource->reduce(function ($result, $order) {
            $channels = array_column($order->methods, 'name');
            return array_unique(array_merge($result, $channels));
        }, []);
        $this->series = array_map(fn($name) => [
            'valueField' => $name,
            'name'       => $name,
        ], $series);

        $this->dataSource = $dataSource->transform(function ($order) {
            $channels = array_column($order->methods, 'total', 'name');
            $channels['date'] = $order->date;
            return $channels;
        })->toArray();
    }
}
