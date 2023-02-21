<?php

namespace App\Dto\Owd\SalesOrderDash;

class OrdersByShipMethod
{
    public array $ordersByShipMethod;
    public array $dataSource = [];
    public array $series = [];

    public static function fromJson(array $data): self
    {
        $instance = new self();
        $instance->ordersByShipMethod = array_map(static function($data) {
            return ShipMethod::fromJson($data);
        }, $data);
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
            $channels = array_column((array)$order->methods, 'name');
            return array_unique(array_merge((array)$result, $channels));
        }, []);
        $this->series = array_map(fn($name) => [
            'valueField' => $name,
            'name'       => $name,
        ], $series);

        $this->dataSource = $dataSource->transform(function ($order) {
            $channels = array_column((array)$order->methods, 'total', 'name');
            $channels['date'] = $order->date;
            return $channels;
        })->toArray();
    }
}

