@php($items->transformToDataSource())
{{--@if( false )--}}
{{--<x-wip-widget-full title="Orders by Channel" />--}}
{{--@else--}}
<x-chart.container class="block-mode-loading">
	<x-block-header title="Orders by Channel" >
		<x-period-selector class="co" />
	</x-block-header>
	<x-block-content class="p-0 d-flex flex-column justify-content-center">
		<div id="orders-channel"></div>
	</x-block-content>
	<x-block-footer />
</x-chart.container>

@push('js_after')
	<script>
		$(function() {
            var chartData = {};
            chartData.today = @json($items->day);
            chartData.month = @json($items->month);
            chartData.quarter = @json($items->quarter);
            chartData.year = @json($items->year);
            chartData.currentTotal = {{$items->year['total']}};

			function splitSeries(period){
                const data = chartData[period];
                chartData.currentTotal = data.total;
                return data.dataSource;
			}

			owd_palette.shuffle();

			var chart = $("#orders-channel").dxPieChart({
				innerRadius: 0.85,
				type: "doughnut",
				dataSource: chartData.year.dataSource,
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
						$footer.html('');
						items.forEach(function(item){
							let legend = $(`
                                        <div class="mr-4 legend">
                                              <i class="legend-dot mr-2" style="background-color: ${item.marker.fill};"></i><span class="ml-1">${item.text}</span>
                                        </div>`);
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
						//format: "fixedPoint",
						radialOffset: -25,
						customizeText: function (point) {
							return point.percentText;
						},
						connector: {
							visible: true,
							width: 1
						}
					}
				}],
				centerTemplate: function(pieChart, container) {
					const content = $(
						`<svg>
							<circle cx="100" cy="100" fill="#fff" r="${pieChart.getInnerRadius() - 6}"></circle>
							<text text-anchor="middle" dominant-baseline="central" x="100" y="90" fill="var(--color-dark)">
								<tspan x="100" style="font-family: 'Roboto Mono'; font-size: 18px; font-weight: 500;" id="channel-order-total">${ (Intl.NumberFormat()).format(chartData.currentTotal) }</tspan>
								<tspan x="100" dy="20px" fill="var(--color-muted)" style="font-family: 'Roboto';font-size: 12px">Orders</tspan>
							</text>
						</svg>`
					);

					container.appendChild(content.get(0));
				}
			}).dxPieChart('instance');

			$('.co [data-period]').on('click', function(){
				$('.co [data-period]').removeClass('active');
				$(this).addClass('active');
				chart.option({
					dataSource: splitSeries( $(this).data('period') )
				});
			});
			$('.co [data-period="year"]').click();
			$("#orders-channel").closest('.block').removeClass('block-mode-loading');
		});
	</script>
@endpush
{{--@endif--}}
