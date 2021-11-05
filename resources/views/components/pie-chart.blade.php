@php
	$component_id = 'pie-chart-' . Str::random();
@endphp

<div {{ $attributes }}>
    <div class="js-pie-chart pie-chart opacity-0" id="{{ $component_id }}">
        <span class="text-center fs-text-md text-{{ $textColor }} font-w500">
        	@if( $percent > 9999 )
        	<small>{{ $formatted }}</small>
        	@else
        	{{ $formatted }}
        	@endif
        </span>
    </div>
</div>

@if( !is_null($percent) )
@pushonce('js_after:easypiechart')
    <script src="{{ asset('js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
@endpushonce

@push('js_after')
	<script>
		$(function() {
			const getCSSProp = (propName) => getComputedStyle(document.documentElement).getPropertyValue(propName);

			$('#{{ $component_id }}').easyPieChart({
				percent: {{ $percent }},
				lineWidth: '{{ $trackWidth }}',
				size: '{{ $size }}',
				@if( $colorClass )
				barColor: function(){
					let ctx = this.renderer.getCtx(),
						canvas = this.renderer.getCanvas(),
						gradient = ctx.createLinearGradient(0,0,canvas.width,0);
						gradient.addColorStop(0, getCSSProp('--color-{{ $colorClass }}-passive'));
						gradient.addColorStop(1, getCSSProp('--color-{{ $colorClass }}-selected'));
					return gradient;
				},
				@elseif( $barColors )
				barColor: function(){
					let ctx = this.renderer.getCtx(),
						canvas = this.renderer.getCanvas(),
						gradient = ctx.createLinearGradient(0,0,canvas.width,0);
					@foreach( $barColors as $color )
						gradient.addColorStop({{ $loop->index / $loop->count }}, "{{ $color }}");
					@endforeach
					return gradient;
				},
				@else
				barColor: "{{ $barColor ?? '#404040' }}",
				@endif
				lineCap: "butt",
				trackColor: "#D4DCE9",
				scaleColor: false
			}).data('easyPieChart').update({{ $percent }});

			$('#{{ $component_id }}').removeClass('opacity-0');
		});
	</script>
@endpush
@endif