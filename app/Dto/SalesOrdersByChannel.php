<?php

namespace App\Dto;

use Illuminate\Support\Collection;

class SalesOrdersByChannel
{
    public array $day = [];
    public array $month = [];
    public array $quarter = [];
    public array $year = [];
    public array $chartColors = ['url(#green-grad)', 'url(#orange-grad)', 'url(#blue-grad)'];

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $dayOrders = $data['day'] ?? [];
        foreach ($dayOrders as $dayOrder) {
            $instance->day[] = SalesOrdersOrderByChannel::fromArray($dayOrder);
        }
        $monthOrders = $data['month'] ?? [];
        foreach ($monthOrders as $monthOrder) {
            $instance->month[] = SalesOrdersOrderByChannel::fromArray($monthOrder);
        }
        $quarterOrders = $data['quarter'] ?? [];
        foreach ($quarterOrders as $quarterOrder) {
            $instance->quarter[] = SalesOrdersOrderByChannel::fromArray($quarterOrder);
        }
        $yearOrders = $data['year'] ?? [];
        foreach ($yearOrders as $yearOrder) {
            $instance->year[] = SalesOrdersOrderByChannel::fromArray($yearOrder);
        }

        return $instance;

    }

    public static function testData(): array
    {
        return [
            'day'     => NULL,
            'month'   =>
                [
                    [
                        'channelName' => 'ShopifyMonth',
                        'total'       => 0,
                    ],
                    [
                        'channelName' => 'WalmartMonth',
                        'total'       => 0,
                    ],
                    [
                        'channelName' => 'AmazonMonth',
                        'total'       => 0,
                    ],
                    [
                        'channelName' => 'channelNameMonth1',
                        'total'       => 4,
                    ],
                    [
                        'channelName' => 'channelNameMonth2',
                        'total'       => 1,
                    ],
                ],
            'quarter' =>
                [
                    [
                        'channelName' => 'channelNameQuarter1',
                        'total'       => 0,
                    ],
                    [
                        'channelName' => 'channelNameQuarter2',
                        'total'       => 0,
                    ],
                    [
                        'channelName' => 'channelNameQuarter3',
                        'total'       => 0,
                    ],
                    [
                        'channelName' => 'channelNameQuarter4',
                        'total'       => 1,
                    ],
                    [
                        'channelName' => 'channelNameQuarter5',
                        'total'       => 22,
                    ],
                    [
                        'channelName' => 'channelNameQuarter6',
                        'total'       => 1,
                    ],
                ],
            'year'    =>
                [
                    [
                        'channelName' => 'channelNameYear1',
                        'total'       => 0,
                    ],
                    [
                        'channelName' => 'channelNameYear2',
                        'total'       => 0,
                    ],
                    [
                        'channelName' => 'channelNameYear3',
                        'total'       => 1,
                    ],
                    [
                        'channelName' => 'channelNameYear4',
                        'total'       => 0,
                    ],
                    [
                        'channelName' => 'channelNameYear5',
                        'total'       => 1,
                    ],
                    [
                        'channelName' => 'channelNameYear6',
                        'total'       => 89,
                    ],
                    [
                        'channelName' => 'channelNameYear7',
                        'total'       => 1,
                    ],
                ],
        ];
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
        $channelOrders = $orders->map(fn(SalesOrdersOrderByChannel $order) => [
            'channel' => $order->channelName,
            'count'   => $order->total,
            'percent' => round($order->total / $total * 100, 2)
        ])->toArray();

        return [
            'total' => $total,
            'dataSource' => $channelOrders
        ];
    }
}
