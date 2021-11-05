@php 
    if( !isset($items) && false ){
        $items = collect();

        $date = Carbon\Carbon::now();
        $order_val = rand(0, 5000);

        while( count($items) < 35 ){
            $date = $date->sub(1, 'day');

            $order_val += rand(0, 500) - 250;
            $order_val = max($order_val, 0);

            $items->push((object)[
                'date' => $date->clone(),
                'orders' => $order_val
            ]);
        }
    }
@endphp

@if( !isset($items) || !$items->count() )
<x-wip-widget-full title="/" />
@else

<x-block>
    <x-block-header title="/">
        <x-period-selector />
    </x-block-header>
    <x-block-content>
        <div class="row justify-content-end">
            <div class="col-12 mt-2">
                <x-stat-block :number="$items->count()" label="/" icon="pending-receive"  color-class="yellow" op="20" class="border-yellow-20"/>
            </div>
        </div>
    </x-block-content>
    <x-block-content class="dx-viewport">
        <div id="returnedItemsChart"></div>
    </x-block-content>
    <x-block-footer />
</x-block>

@pushonce('js_after:areaSettings')
    <script src="{{ asset('js/globalAreaSettings.js') }}"></script>
@endpushonce

@push('js_after')
    <script>
        $(function() {
            /* Area Chart */
            var dataSource = @json( $items->values() );

            owd_palette.shuffle();
            var chart = $("#returnedItemsChart").dxChart(
                $.extend(true, {}, globalAreaSettings, {
                    palette: owd_palette.colors,
                    dataSource: dataSource,
                    size: {
                        height: 150
                    },
                    commonSeriesSettings: {
                        type: 'area',
                        argumentField: "date",
                    },
                    series: owd_palette.applySeriesColors([
                        { 
                            valueField: "orders",
                            name: "Channel 1", 
                        }
                    ]),
                    margin: {
                        bottom: 4
                    },
                    argumentAxis: {
                        argumentType: 'datetime',
                    },
                })
            ).dxChart("instance");
        });
    </script>
@endpush
@endif