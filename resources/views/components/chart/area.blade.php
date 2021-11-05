@props(['id', 'title', 'settings' => (object)[], 'tooltip' => null])

<x-chart.container>
	<x-block-header title="{{ $title }}" :tooltip="$tooltip">
		<div class="dropdown">
			<x-dropdown.button class="btn-blue" />
			<x-dropdown.list class="dropdown-menu-right" />
		</div>
	</x-block-header>
	<x-block-content class="block-content-chart-area">        
		<div id="{{ $id }}" class="mt-4"></div>
	</x-block-content>
	<x-block-footer class="justify-content-between">
		<span>View Reports</span>
        <button type="button" class="btn btn-blue btn-link has-icon">
            <b>Details</b> <x-icons.goto-12x  />
        </button>
	</x-block-footer>
</x-chart.container>

@push('js_after')
	<script>
		$(function() {
			var dataSource = [{
				month: 0,
				dp1: 20000,
				dp2: 8000
			}, {
				month: 10,
				dp1: 30000,
				dp2: 15000
			}, {
				month: 20,
				dp1: 21000,
				dp2: 11000
			}, {
				month: 30,
				dp1: 10000,
				dp2: 21000
			}, {
				month: 40,
				dp1: 30000,
				dp2: 40000
			}, {
				month: 50,
				dp1: 42000,
				dp2: 30000
			}, {
				month: 60,
				dp1: 42000,
				dp2: 39000
			},
			{
				month: 80,
				dp1: 38000,
				dp2: 40000
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
					{ valueField: 'dp1' },
					{ valueField: 'dp2' }
				]),
				margin: { bottom: 6 },
				title: '',
				argumentAxis: { tickInterval: 10 },
				size: { height: 274 }
			}, @json($settings))).dxChart('instance');
		});
	</script>
@endpush