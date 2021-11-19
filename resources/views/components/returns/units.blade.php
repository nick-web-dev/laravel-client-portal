@if( empty($dataSource))
<x-wip-widget-full title="Returned Units" />
@else

<x-block class="returned-units-block block-mode-loading">
	<x-block-header title="Returned Units">
		<x-period-selector class="ru" />
	</x-block-header>
	<x-block-content>
		<div class="row justify-content-end">
			<div class="col-12 mt-2">
				<x-stat-block :number="0" label="Returned Units" icon="items-returned"  color-class="yellow" op="20" class="border-yellow-20"/>
			</div>
		</div>
	</x-block-content>
	<x-block-content class="dx-viewport">
		<div id="returnedUnitsChart"></div>
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
			/* Area Chart */
			var dataSource = @json( $dataSource );

			owd_palette.shuffle();
			var chart = $("#returnedUnitsChart").dxChart(
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
					series: @json($series),
					valueAxis: {
						showZero: true
					},
					argumentAxis: {
						argumentType: 'datetime',
                		tickInterval: {days: 1},
					},
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
						$('.returned-units-block .stat-number').text(total);
					}
				})
			).dxChart("instance");

			chart.setDateSlice = setDateSlice;

			$('.ru [data-period]').on('click', function(){
				$('.ru [data-period]').removeClass('active');
				$(this).addClass('active');

				chart.setDateSlice( $(this).data('period') );
			});
			$('.ru [data-period="month"]').click();

			$('.returned-units-block').removeClass('block-mode-loading');
		});
	</script>
@endpush
@endif
