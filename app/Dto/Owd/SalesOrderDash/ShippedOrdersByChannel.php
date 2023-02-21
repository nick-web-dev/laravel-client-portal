<?php

namespace App\Dto\Owd\SalesOrderDash;

use Illuminate\Support\Collection;

class ShippedOrdersByChannel
{
    /** @var Day[] */
    public array $day;
    /** @var Month[] */
    public array $month;
    /** @var Quarter[] */
    public array $quarter;
    /** @var Year[] */
    public array $year;
    public array $chartColors = ['url(#green-grad)', 'url(#orange-grad)', 'url(#blue-grad)'];

    public static function fromJson(array $data): self
    {
        $instance = new self();
        $instance->day = array_map(static function($data) {
            return ShippedOrdersChannels::fromJson($data);
        }, $data['day']);
        $instance->month = array_map(static function($data) {
            return ShippedOrdersChannels::fromJson($data);
        }, $data['month']);
        $instance->quarter = array_map(static function($data) {
            return ShippedOrdersChannels::fromJson($data);
        }, $data['quarter']);
        $instance->year = array_map(static function($data) {
            return ShippedOrdersChannels::fromJson($data);
        }, $data['year']);
        return $instance;
    }

    public function transformToDataSource(): void
    {
        $this->day = $this->toDxPieChart(collect($this->day));
        $this->month = $this->toDxPieChart(collect($this->month));
        $this->quarter = $this->toDxPieChart(collect($this->quarter));
        $this->year = $this->toDxPieChart(collect($this->year));
    }

    private function toDxPieChart(Collection $orders): array
    {
        $total = $orders->sum('total');
        $channelOrders = $orders->map(function (ShippedOrdersChannels $order) use ($total) {
            if (0 === $total) {
                $percent = 0;
            } else {
                $percent = round($order->total / $total * 100, 2);
            }
            return [
                'channel' => $order->name,
                'count'   => $order->total,
                'percent' => $percent
            ];
        })->toArray();

        return [
            'total' => $total,
            'dataSource' => $channelOrders
        ];
    }
}
