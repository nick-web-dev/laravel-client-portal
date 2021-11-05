@props(['items'])

@php 
    use \Carbon\Carbon;
    
    $items = collect($items);
    $dataSource = collect($items);

    $dataSource->transform(function($dayOrders){
        $item = collect($dayOrders->methods);
        $item = $item->flatMap(function($method){
            return [$method->name => $method->total];
        })->all();
        $item['date'] = (new Carbon($dayOrders->date))->toDateString();
        return $item;
    });

    $series = [];

    foreach( $items[0]->methods as $method ){
        array_push($series, (object)[
            'valueField' => $method->name,
            'name' => $method->name
        ]);
    }
@endphp

@if( !isset($dataSource) || !$dataSource || !$dataSource->count() )
<x-wip-widget-full title="Orders by Ship Method" />
@else

@push('css_after')
<style>
    .methods-legend .simplebar-content {
        white-space: nowrap;
        padding-left: 20px !important;
    }
    .methods-legend .legend {
        display: inline-flex;
        white-space: nowrap;
        margin-top: 1.25em;
    }

    .methods-legend .simplebar-scrollbar {
        height:  4px !important;
    }

    .methods-legend .simplebar-track.simplebar-horizontal {
        height:  6px !important;
    }
</style>
@endpush

<x-block class="block-mode-loading">
    <x-block-header title="Orders by Ship Method">
        <x-period-selector class="obm-controls" />
    </x-block-header>
    <x-block-content class="d-flex flex-column justify-content-center pt-5">
        <div id="orders-by-method"></div>
    </x-block-content>
    {{-- <x-block-footer class="methods-legend" /> --}}
    <x-block-footer />
</x-block>

@pushonce('js_after:moment')
    <script src="{{ asset('js/plugins/moment/moment.min.js') }}"></script>
@endpushonce
@push('js_after')
<script>
    $(function(){
        yearOrders = @json($dataSource->values()->toArray());

        chart2 = $("#orders-by-method").dxChart( $.extend(true, {}, globalAreaSettings, {
            palette: owd_palette.colors,
            dataSource: yearOrders,
            commonSeriesSettings: {
                type: 'area',
                argumentField: "date"
            },
            series: owd_palette.applySeriesColors( @json($series) ),
            size: {
                height: 246
            },
            title: "",
            argumentAxis: {
                argumentType: 'datetime',
                valueMarginsEnabled: false,
                tickInterval: {days: 1},
            },
            zoomAndPan: {
                argumentAxis: "both",
            },
            // Implemented dropdown box for legend
            // onDrawn: function(){
            //     new SimpleBar( $('.methods-legend')[0] );
            // }
        }) ).dxChart("instance");

        chart2.setDateSlice = setDateSlice;

        $('.obm-controls [data-period]').on('click', function(){
            $('.obm-controls [data-period]').removeClass('active');
            $(this).addClass('active');

            chart2.setDateSlice( $(this).data('period') );
        });
        $('.obm-controls [data-period="month"]').click();

        $("#orders-by-method").closest('.block').removeClass('block-mode-loading');
    });
</script>
@endpush
@endif