@php
	use \Carbon\Carbon;

	$items = collect( $items );

	$dataSource = collect( $items )
		// ->where('status', 'shipped')
		->filter(function($order){
			return (new Carbon($order->date))->isCurrentMonth();
		})->sortBy('date');

	// $dataSource = $items->groupBy('date');

	$dataSource->transform(function($dayOrders){
		$item = collect($dayOrders->channels);
		$item = $item->flatMap(function($channel){
			return [$channel->name => $channel->total];
		})->all();
		$item['date'] = (new Carbon($dayOrders->date))->toDateString();
		return $item;
	});

	$series = [];

	foreach( $items[0]->channels as $channel ){
		array_push($series, (object)[
			'valueField' => $channel->name,
			'name' => $channel->name
		]);
	}
@endphp

@if( !isset($items) || !$items->count() )
<x-wip-widget-full title="Shipped Orders" />
@else
<x-chart.container class="block-mode-loading" >
	<x-block-header title="Shipped Orders">
		<x-period-selector class="so" :exclude="['t', 'q', 'y']" />
	</x-block-header>
	<x-block-content>
		<div id="shippedOrders" class="mt-4"></div>
	</x-block-content>
	<x-block-footer />
</x-chart.container>


@pushonce('js_after:moment')
	<script src="{{ asset('js/plugins/moment/moment.min.js') }}"></script>
@endpushonce

@push('js_after')
<script>
	$(function(){
		var dataSource = @json($dataSource->values()->toArray());

		// This was used to create a view of overlapping 
		// weeks/months, now deprecated.

		// function splitSeries(period){
		// 	let new_source = [], 
		// 		series = [];

		// 	dataSource.forEach(item => {
		// 		let arg_key, val_key = null;
		// 		let date_obj = moment(item.date);
		// 		switch( period ){
		// 			case 'week':
		// 				arg_key = date_obj.format('ddd');

		// 				let m_start = date_obj.clone().startOf('month');
		// 				let w_start = m_start.clone().startOf('week');
		// 				let offset = m_start.diff(w_start, 'days');

		// 				let week_number = Math.ceil((date_obj.date() + offset) / 7);

		// 				val_key = `${date_obj.format('MMM')} W${week_number}`;
		// 				break;
		// 			case 'month':
		// 				arg_key = date_obj.date();
		// 				val_key = date_obj.format('MMM');
		// 				break;
		// 		}
				
		// 		let dat_item = new_source.find(el => el.key == arg_key);

		// 		if( dat_item == undefined ){
		// 			dat_item = {
		// 				key: arg_key
		// 			};
		// 			new_source.push(dat_item);
		// 		}
		// 		dat_item[ val_key ] = item.value;

		// 		let ser_item = series.find(el => el.name == val_key);
		// 		if( ser_item == undefined ){
		// 			series.push({
		// 				valueField: val_key,
		// 				name: val_key
		// 			});
		// 		}
		// 	});

		// 	if( period == 'week' ){
		// 		const sorter = {
		// 			"sun": 0, // << if sunday is first day of week
		// 			"mon": 1,
		// 			"tue": 2,
		// 			"wed": 3,
		// 			"thu": 4,
		// 			"fri": 5,
		// 			"sat": 6,
		// 			// "sun": 7
		// 		}

		// 		new_source.sort(function sortByDay(a, b) {
		// 			let day1 = a.key.toLowerCase();
		// 			let day2 = b.key.toLowerCase();
		// 			return sorter[day1] - sorter[day2];
		// 		});
		// 	}

		// 	return [new_source, series];
		// }

		owd_palette.shuffle();
		var chart = $('#shippedOrders').dxChart( $.extend(true, {}, globalAreaSettings, {
			palette: owd_palette.colors,
			dataSource: dataSource,
			commonSeriesSettings: {
				type: 'stackedarea',
				argumentField: 'date'
			},
			margin: {
				bottom: 20
			},
			series: owd_palette.applySeriesColors( @json($series) ),
			title: '',
			argumentAxis: {
				argumentType: 'datetime',
				valueMarginsEnabled: false,
                tickInterval: {days: 1},
                aggregationInterval: 'day',
                allowDecimals: false
			},
			zoomAndPan: {
				argumentAxis: 'both',
			},
			size: {
				height: 254
			}
		}) ).dxChart('instance');

        chart.setDateSlice = setDateSlice;

		$('.so [data-period]').on('click', function(){
			$('.so [data-period]').removeClass('active');
			$(this).addClass('active');

            chart.setDateSlice( $(this).data('period') );
		});
		$('.so [data-period="week"]').click();


   //      $('.so [data-period]').on('click', function(){
   //          $('.so [data-period]').removeClass('active');
   //          $(this).addClass('active');

   //          let [dataSource, series] = splitSeries( $(this).data('period') );

   //          console.log( series, dataSource );

			// chart.option({
			// 	series: owd_palette.applySeriesColors(series),
			// 	dataSource: dataSource
			// });
   //      });
   //      $('.so [data-period="month"]').click();

		$("#shippedOrders").closest('.block').removeClass('block-mode-loading');
	});
</script>
@endpush
@endif