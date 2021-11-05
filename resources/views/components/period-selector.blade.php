@props([
	'periods' => [
		't' => 'Today',
		'w' => 'Week',
		'm' => 'Month',
		'q' => 'Quarter',
		'y' => 'Year'
	],
	'exclude' => ['w']
])

@php
	$periods = array_diff_key($periods, array_flip($exclude));
@endphp

<div {{ $attributes->merge(['class' => 'btn-group']) }}>
	@foreach( $periods as $abbr => $value )
		<button class="btn btn-ghost btn-blue" data-period="{{ strtolower($value) }}" type="button"><b>{{ ucfirst($abbr) }}</b></button>
		@unless( $loop->last )
		<div class="divider"></div>
		@endunless
	@endforeach
</div>

@pushonce('js_after:period_selector')
<script>
	function setDateSlice(period) {
		switch(period) {
			case "year": 
				this.option({
					argumentAxis: {
						aggregationInterval: "month",
						tickInterval: "month"
					}
				});

				this.series[0]._argumentAxis.visualRange(
					moment().startOf(period), 
					moment().endOf(period)
				);
				break;
			case "quarter": 
				this.option({
					argumentAxis: {
						aggregationInterval: "month",
						tickInterval: "month"
					}
				});

				this.series[0]._argumentAxis.visualRange(
					moment().startOf(period), 
					moment().endOf(period)
				);

				break;
			case "month": 
				this.option({
					argumentAxis: {
						aggregationInterval: "day",
						tickInterval: "day"
					}
				});

				this.series[0]._argumentAxis.visualRange(
					moment().startOf(period), 
					moment().subtract(1, "days")
				);

				break;
			case "week": 
				this.option({
					argumentAxis: {
						aggregationInterval: "day",
						tickInterval: "day"
					}
				});

				this.series[0]._argumentAxis.visualRange(
					moment().startOf(period), 
					moment().endOf(period).subtract(1, "days")
				);

				break;
			case "today":
				this.option({
					argumentAxis: {
						aggregationInterval: "day",
						tickInterval: "day"
					}
				});

				this.series[0]._argumentAxis.visualRange(moment().startOf('day').subtract(1, 'days'), moment().endOf('day'));
				break;
		}
	}
</script>
@endpushonce