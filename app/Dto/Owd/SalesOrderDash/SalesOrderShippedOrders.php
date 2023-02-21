<?php

namespace App\Dto\Owd\SalesOrderDash;

use Illuminate\Support\Carbon;

class SalesOrderShippedOrders
{
    /** @var ShippedOrders[] */
    public array $shippedOrders;
    public array $dataSource = [];
    public array $series = [];

    public static function fromJson(array $data): self
    {
        $instance = new self();
        $instance->shippedOrders = array_map(static function($data) {
            return ShippedOrders::fromJson($data);
        }, $data);
        return $instance;
    }

    public function haveNoOrders(): bool
    {
        return empty($this->dataSource);
    }

    public function prepareDataSource(): void
    {
        $dataSource = collect($this->shippedOrders)
            ->filter(fn($order) => (new Carbon($order->date))->isCurrentMonth());

        $series = $dataSource->reduce(function ($result, $order) {
            $channels = array_column((array)$order->channels, 'name');
            return array_unique(array_merge((array)$result, $channels));
        }, []);
        $this->series = array_map(fn($name) => [
            'valueField' => $name,
            'name'       => $name,
        ], $series);

        $this->dataSource = $dataSource->transform(function ($order) {
            $channels = array_column((array)$order->channels, 'total', 'name');
            $channels['date'] = $order->date;
            return $channels;
        })->toArray();
    }
}
