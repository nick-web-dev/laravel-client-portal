@props(['id' => 'expiring_products'])

<x-chart.container>
    <x-block-header title="Expiring Products">
        <x-period-selector class="ep" />
    </x-block-header>
    <x-block-content class="block-content-chart-area">        
        <div id="{{ $id }}" class="mt-4"></div>
    </x-block-content>
    <x-block-footer class="justify-content-between">
        <span>View Reports</span>
        <button type="button" class="btn btn-blue btn-link has-icon">
            <b>Details</b> <x-icons.goto-12x />
        </button>
    </x-block-footer>
</x-chart.container>

@push('js_after')
    <script>
        $(function() {
            var dataSource = [{
                month: 0,
                dp1: 20,
                dp2: 8
            },{
                month: 1,
                dp1: 30,
                dp2: 15
            },{
                month: 2,
                dp1: 21,
                dp2: 11
            },{
                month: 3,
                dp1: 10,
                dp2: 21
            },{
                month: 4,
                dp1: 30,
                dp2: 40
            },{
                month: 5,
                dp1: 42,
                dp2: 30
            },{
                month: 6,
                dp1: 42,
                dp2: 39
            },{
                month: 8,
                dp1: 38,
                dp2: 40
            }];
            owd_palette.shuffle();
            var chart = $('#{{ $id }}').dxChart($.extend(true, {}, globalAreaSettings, {
                palette: owd_palette.colors,
                dataSource: dataSource,
                commonSeriesSettings: {
                    argumentField: 'month',
                    type: 'area'
                },
                series: owd_palette.applySeriesColors([
                    { valueField: 'dp1' }
                ]),
                margin: { bottom: 6 },
                title: '',
                argumentAxis: {
                    tickInterval: 1,
                },
                size: { height: 255 }
            })).dxChart('instance');
        });
    </script>
@endpush