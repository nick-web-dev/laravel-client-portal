@php 
    if( !isset($items) && false ){
        $items = collect();
        $total = 100;
        while( $items->count() < 2 ){
            $diff = rand(0, $total);
            $total = max(0, $total - $diff);
            $items->push((object)[
                'channel' => 'Channel ' . $items->count(),
                'orderCount' => rand(0, 1000),
                'percent' => $diff,
            ]);
        }
        $items->push((object)[
            'channel' => 'Channel ' . $items->count(),
            'orderCount' => rand(0, 1000),
            'percent' => $total,
        ]);
    }
@endphp

@if( !isset($items) || !$items->count() )
<x-wip-widget-full title="Orders by Channel" />
@else
<x-chart.container class="block-mode-loading">
    <x-block-header title="Orders by Channel" />
    <x-block-content class="p-0 d-flex flex-column justify-content-center">
        <div id="orders-channel"></div>
    </x-block-content>
    <x-block-footer />
</x-chart.container>

@push('js_after')
    @php $chartColors = collect(['green', 'orange', 'blue']); @endphp
    <x-gradient-palette 
        element_id="orders-channel" 
        :palette="$chartColors->toArray()"
        :use-classes="true"
        :stroke="true"
        :opaque="true">
    </x-gradient-palette>

    <script>
        $(function() {
            var dataSource = @json( $items );

            owd_palette.shuffle();

            $("#orders-channel").dxPieChart({
                innerRadius: 0.85,
                type: "doughnut",
                palette: @json( $chartColors->map(function($color){ return "url(#orders-channel-grad-$color)"; }) ),
                dataSource: dataSource,
                startAngle: 90,
                diameter: .95,
                size: {
                    height: 210
                },
                legend: {
                    visible: false,
                    customizeItems: function(items){
                        if( !items.length ) {return;}
                        let $footer = items[0].points[0].series._renderer._$container.closest('.block').find('.block-footer');
                        items.forEach(function(item){

                            let matcher = /url\(#pie-grad-([a-z]*)\)/;

                            let color = item.marker.fill.replace(matcher, '$1');

                            // let color = item.series._styles.normal.border.stroke;
                            // let color = 'var(--color-green)';
                            // let hexPattern = /#[a-z0-9]{6}/i;
                            // let color = (hexPattern.test( item.marker.fill ) 
                            //  ? item.marker.fill 
                            //  : `var(--color-${item.marker.fill})`);
                            let legend = $(`<div class="mr-4 legend"><i class="legend-dot mr-2" style="background: ${color};"></i><span class="ml-1">${item.text}</span></div>`);
                            let point = item.points[0];

                            $footer.append(legend);
                            point.legend = legend;

                            legend.click(() => {
                                legend.parent().find('.selected').removeClass('selected');
                                if( !point.isSelected() ){
                                    point.select();
                                    legend.addClass('selected');
                                } else {
                                    point.clearSelection();
                                }
                            });
                        });
                    }
                },
                onPointClick: function(e){
                    e.target.legend.parent().find('.selected').removeClass('selected');

                    if( !e.target.isSelected() ){
                        e.target.select();
                        e.target.legend.addClass('selected');
                    } else {
                        e.target.clearSelection();
                    }
                },
                export: {
                    enabled: false
                },
                commonSeriesSettings:{
                    hoverStyle: {
                        border: { width: 2, visible: true },
                        hatching: {
                            direction: 'none',
                            opacity: 0.25
                        }
                    },
                    selectionStyle: {
                        border: { width: 5, visible: true },
                        hatching: {
                            direction: 'none',
                            opacity: 0.25
                        }
                    }
                },
                series: [{
                    smallValuesGrouping: {
                        mode: "topN",
                        topCount: 3
                    },
                    argumentField: "channel",
                    valueField: "percent",
                    label: {
                        visible: true,
                        font: {
                            color: '#404040',
                            family: 'Roboto Mono',
                            size: '14px',
                            weight: '400'
                        },
                        backgroundColor: 'transparent',
                        format: "fixedPoint",
                        radialOffset: -25,
                        customizeText: function (point) {
                            return point.valueText + "%";
                        },
                        connector: {
                            visible: false,
                            width: 1
                        }
                    }
                }],
                centerTemplate: function(pieChart, container) { 
                    var orderCount = pieChart.getAllSeries()[0].getVisiblePoints().reduce(function(s, p) { return s + p.data.orderCount; }, 0),
                        content = $(
                            `<svg>
                                <circle cx="100" cy="100" fill="#fff" r="${pieChart.getInnerRadius() - 6}"></circle>
                                <text text-anchor="middle" dominant-baseline="central" x="100" y="90" fill="var(--color-dark)">
                                    <tspan x="100" style="font-family: 'Roboto Mono'; font-size: 18px; font-weight: 500;">${orderCount.toString().padStart(6, '0')}</tspan>
                                    <tspan x="100" dy="20px" fill="var(--color-muted)" style="font-family: 'Roboto';font-size: 12px">Orders</tspan>
                                </text>
                            </svg>`
                        );
                    
                    container.appendChild(content.get(0));
                }
            });

            $("#orders-channel").closest('.block').removeClass('block-mode-loading');
        });
    </script>
@endpush
@endif