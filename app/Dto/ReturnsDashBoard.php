<?php

namespace App\Dto;

class ReturnsDashBoard
{
    public array $returnedOrders;
    public array $averageReturns;
    public array $topReturnedItems;
    public array $returnedUnits;
    public $returnRate;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->returnedOrders = $data['returnedOrders'] ?? [];
        $averageReturns = $data['averageReturns'][0] ?? [];
        $instance->averageReturns = [
            'orders' => $averageReturns['orders'] ?? 0,
            'unitsPerOrder' => $averageReturns['unitsPerOrder'] ?? 0,
        ];
        $instance->topReturnedItems = $data['topReturnedItems'] ?? [];
        $instance->returnedUnits = $data['returnedUnits'] ?? [];
        $instance->returnRate = $data['returnRate'] ?? 0;

        return $instance;
    }

    public function ordersDataSource(): array
    {
        return $this->getDatasourceAndSeries($this->returnedOrders);
    }

    public function returnedUnitsDataSource(): array
    {
        return $this->getDatasourceAndSeries($this->returnedUnits);
    }

    private function getDatasourceAndSeries(array $data)
    {
        $series = array_reduce($data, function ($result, $order) {
            $channels = array_column($order['channels'] ?? [], 'name');
            return array_unique(array_merge($result, $channels));
        }, []);
        $series = array_map(fn($name) => [
            'valueField' => $name,
            'name'       => $name,
        ], $series);

        $dataSource = array_map(function ($order) {
            $orderData = array_column($order['channels'] ?? [],
                'total',
                'name');
            $orderData['date'] = $order['date'];

            return $orderData;
        }, $data);

        return [$dataSource, $series];
    }
}
