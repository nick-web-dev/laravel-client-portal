@php
	$items = collect( $items );

	$counted = $items->countBy(function($order){
		return $order->channel;
	});

	$counted = $counted->map(function( $count, $channel ) use ($counted){
		return (object)[
			'channel' => $channel,
			'percent' => $count / $counted->sum() * 100
		];
	})->values();
@endphp

@if( !isset($items) || !$items->count() )
<x-wip-widget-full title="Orders by Channel" />
@else
<x-chart.container class="block-mode-loading">
	<x-block-header title="Orders by Channel" >
		<x-period-selector class="co" />
	</x-block-header>
	<x-block-content class="p-0 d-flex flex-column justify-content-center">
		<div id="orders-channel"></div>
	</x-block-content>
	<x-block-footer />
</x-chart.container>

@pushonce('js_after:moment')
	<script src="{{ asset('js/plugins/moment/moment.min.js') }}"></script>
@endpushonce

@push('js_after')
	@php $chartColors = collect(['green', 'orange', 'blue']); @endphp

	<script>
		$(function() {
			var dataSource = @json( $counted );
			var dataSource2 = @json( $items );
			var today = moment();
		
			function splitSeries(period){
				let new_source = [],
					total = 0,
					totals = {};

				if( period == 'today' ){
					period = 'day';
				}

				dataSource2.filter(item => {
					let date_obj = moment(item.date);
					return date_obj.isSame(today, period);
				}).forEach(item => {
					if( totals[item.channel] == undefined ){
						totals[item.channel] = 1;
					} else {
						totals[item.channel]++;
					}
					total++;
				});

				for(let prop in totals){
					new_source.push({
						channel: prop,
						count: totals[prop],
						percent: totals[prop] / total
					});
				}

				return [new_source, total];
			}

			owd_palette.shuffle();

			var chart = $("#orders-channel").dxPieChart({
				innerRadius: 0.85,
				type: "doughnut",
				palette: @json( $chartColors->map(function($color){ return "url(#$color-grad)"; }) ),
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
						$footer.html('');
						items.forEach(function(item){

							let matcher = /url\(#([a-z]*)-grad\)/;

							let color = item.marker.fill.replace(matcher, '$1');



							// let color = item.series._styles.normal.border.stroke;
							// let color = 'var(--color-green)';
							// let hexPattern = /#[a-z0-9]{6}/i;
							// let color = (hexPattern.test( item.marker.fill ) 
							//  ? item.marker.fill 
							//  : `var(--color-${item.marker.fill})`);
							let legend = $(`<div class="mr-4 legend"><i class="legend-dot mr-2" style="background-color: var(--color-${color});"></i><span class="ml-1">${item.text}</span></div>`);
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
							return point.percentText;
						},
						connector: {
							visible: false,
							width: 1
						}
					}
				}],
				centerTemplate: function(pieChart, container) { 
					var orderCount = pieChart.getAllSeries()[0].getVisiblePoints().reduce(function(s, p) { return s + p.data.count; }, 0),
						content = $(
						`<svg>
							<circle cx="100" cy="100" fill="#fff" r="${pieChart.getInnerRadius() - 6}"></circle>
							<text text-anchor="middle" dominant-baseline="central" x="100" y="90" fill="var(--color-dark)">
								<tspan x="100" style="font-family: 'Roboto Mono'; font-size: 18px; font-weight: 500;" id="channel-order-total">${ (Intl.NumberFormat()).format(orderCount) }</tspan>
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

				let [dataSource, total] = splitSeries( $(this).data('period') );

				$('#channel-order-total').html( total.toString().padStart(6, '0'));

				chart.option({
					dataSource: dataSource
				});
			});
			$('.co [data-period="year"]').click();

			$("#orders-channel").closest('.block').removeClass('block-mode-loading');
		});
	</script>
@endpush
@endif