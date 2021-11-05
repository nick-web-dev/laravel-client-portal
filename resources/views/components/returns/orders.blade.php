@php
	use \Carbon\Carbon;

    $items = collect($items);
@endphp

@if( !isset($items) || !$items->count() )
<x-wip-widget-full title="Returned Orders" />
@else

@php
	// $total = $items->where('status', 'completed')->count();

	// $items = $items->whereIn('status', ['completed', 'null'])->groupBy('date');

	// $dataSource = $items->map(function($list, $date){
	// 	$basis = collect(['Shopify' => 0, 'Walmart' => 0, 'Amazon' => 0, 'date' => $date]);
	// 	return $basis->merge($list->countBy(function($item){
	// 		return $item->status != 'null' ? $item->channel : false;
	// 	}));
	// });

	$dataSource = $items;

    $dataSource->transform(function($day){
        $item = collect($day->channels);
        $item = $item->flatMap(function($channel){
            return [$channel->name => $channel->total];
        })->all();
        $item['date'] = (new Carbon($day->date))->toDateString();
        return $item;
    });
@endphp

<x-block class="returned-orders-block block-mode-loading">
	<x-block-header title="Returned Orders">
		<x-period-selector class="ro" />
	</x-block-header>
	<x-block-content>
		<div class="row justify-content-end">
			<div class="col-12 mt-2">
				<x-stat-block :number="0" label="Returned Orders" icon="items-returned"  color-class="yellow" op="20" class="border-yellow-20"/>
			</div>
		</div>
	</x-block-content>
	<x-block-content class="dx-viewport">
		<div id="returnedOrdersChart"></div>
	</x-block-content>
	<x-block-footer />
</x-block>

@pushonce('js_after:moment')
	<script src="{{ asset('js/plugins/moment/moment.min.js') }}"></script>
@endpushonce

@pushonce('js_after:areaSettings')
	<script src="{{ asset('js/globalAreaSettings.js') }}"></script>
@endpushonce

@push('js_after')
	<script>
		$(function() {
			/* Returned Orders */
			var dataSource = @json( $dataSource->values() );

			owd_palette.shuffle();
			var chart = $("#returnedOrdersChart").dxChart(
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
					argumentAxis: {
						argumentType: 'datetime',
                		tickInterval: {days: 1},
						valueMarginsEnabled: false,
					},
					series: owd_palette.applySeriesColors([
						{ 
							valueField: "Walmart",
							name: "Walmart", 
						},{ 
							valueField: "Shopify",
							name: "Shopify",
						},{ 
							valueField: "Amazon",
							name: "Amazon",
						}
					]),
					zoomAndPan: {
						argumentAxis: "both",
					},
					margin: {
						bottom: 4
					},
					onZoomEnd: function(e){
						let total = 0;
						e.component.series[0].getVisiblePoints().forEach(p => {
							for(let prop in p.data){
								if(prop != '0' && prop != 'date' && p.data[prop]){
									// console.log(p.data, prop);
									total += p.data[prop];
								}
							}
							total = Math.round(total);
						});
						$('.returned-orders-block .stat-number').text(total);
					}
				})
			).dxChart("instance");

			chart.setDateSlice = setDateSlice;

			$('.ro [data-period]').on('click', function(){
				$('.ro [data-period]').removeClass('active');
				$(this).addClass('active');

				chart.setDateSlice( $(this).data('period') );
			});
			$('.ro [data-period="month"]').click();

			$('.returned-orders-block').removeClass('block-mode-loading');
		});
	</script>
@endpush
@endif