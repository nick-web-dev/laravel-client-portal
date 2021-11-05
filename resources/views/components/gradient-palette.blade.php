@props([ 
	'elementId',
	'palette',
	'useClasses' => false,
	'stroke' => false,
	'opaque' => false,
])

@php
if( !function_exists('adjustBrightness') ){
	function adjustBrightness($hexCode, $adjustPercent) {
		$hexCode = ltrim($hexCode, '#');

		if (strlen($hexCode) == 3) {
			$hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
		}

		$hexCode = array_map('hexdec', str_split($hexCode, 2));

		foreach ($hexCode as & $color) {
			$adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
			$adjustAmount = ceil($adjustableLimit * $adjustPercent);

			$color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
		}

		return '#' . implode($hexCode);
	}
}
@endphp

<svg height="0" width="0">
<defs>
	@foreach( $palette as $color )
		<lineargradient id="{{ $elementId }}-grad-{{ $color }}" x1="0%" x2="0%" y1="0%" y2="100%">
		@unless( $useClasses )
			<stop offset="0%" stop-color="{{ adjustBrightness($color, 0.95) }}" stop-opacity="1"></stop>
			<stop offset="100%" stop-color="{{ $color }}" stop-opacity="1"></stop>
		@elseif( $opaque )
			<stop offset="0%" stop-color="var(--color-{{ $color }}-passive)" stop-opacity="1"></stop>
			<stop offset="100%" stop-color="var(--color-{{ $color }}-selected)" stop-opacity="1"></stop>
		@else
			<stop offset="0%" stop-color="var(--color-{{ $color }})" stop-opacity="0.3"></stop>
			<stop offset="100%" stop-color="var(--color-{{ $color }})" stop-opacity="0.9"></stop>
		@endunless
		</lineargradient>
	@endforeach
</defs>
</svg>

<style>
	@foreach( $palette as $color )
		#{{ $elementId }} [fill="{{ $color }}"] {
			fill: url(#{{ $elementId }}-grad-{{ $loop->index }});
			@if( $stroke )
			stroke: url(#{{ $elementId }}-grad-{{ $loop->index }});
			stroke-linejoin: miter;
			@endif
		}
	@endforeach
</style>