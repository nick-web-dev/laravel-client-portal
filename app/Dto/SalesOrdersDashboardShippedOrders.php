<?php

namespace App\Dto;

use Illuminate\Support\Carbon;

class SalesOrdersDashboardShippedOrders
{
    /** @var SalesOrdersShippedOrder[] $shippedOrders */
    public array $shippedOrders = [];
    public array $dataSource = [];
    public array $series = [];

    public static function fromArray(array $data): self
    {
        $instance = new self();
        foreach ($data as $shippedOrder) {
            $instance->shippedOrders[] = SalesOrdersShippedOrder::fromArray($shippedOrder);
        }

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
            $channels = array_column($order->channels, 'name');
            return array_unique(array_merge($result, $channels));
        }, []);
        $this->series = array_map(fn($name) => [
            'valueField' => $name,
            'name'       => $name,
        ], $series);

        $this->dataSource = $dataSource->transform(function ($order) {
            $channels = array_column($order->channels, 'total', 'name');
            $channels['date'] = $order->date;
            return $channels;
        })->toArray();
    }
}
