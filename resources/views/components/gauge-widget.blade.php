@php
	$percent = $percent ?? 0;

	if( !function_exists('map_range') ){
		function map_range($value, $fromLow, $fromHigh, $toLow, $toHigh) {
			return ($value - $fromLow) * (($toHigh - $toLow) / ($fromHigh - $fromLow)) + $toLow;
		}
	} 

	$needle = map_range($percent, 0, 1, -135, 135);
	$filler = map_range($percent, 0, 1, 299, 110);
@endphp

<div {{ $attributes->merge(['class' => 'needle-gauge']) }}>
	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:serif="http://www.serif.com/" width="86" height="81" viewBox="0 0 86 86" version="1.1" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
		<defs>
			<lineargradient id="needle-grad" x1="0%" x2="0%" y1="0%" y2="100%">
			@if( $gradient )
				<stop offset="0%" stop-color="var(--color-{{ $colorClass }}-passive)" stop-opacity="1"></stop>
				<stop offset="100%" stop-color="var(--color-{{ $colorClass }}-selected)" stop-opacity="1"></stop>
			@else
				<stop offset="0%" stop-color="var(--color-{{ $colorClass }})" stop-opacity="1"></stop>
				<stop offset="100%" stop-color="var(--color-{{ $colorClass }})" stop-opacity="1"></stop>
			@endif
			</lineargradient>
		</defs>
		<style>
			.needle-gauge .needle {
				transform-origin: center;
				animation: rotateNeedle 1s cubic-bezier(0.25, 0.1, 0.61, 1.43);
			}
			.needle-gauge .fill-meter {
				transform: scale(-1) rotate(-45deg);
				transform-origin: center;
				stroke: url(#needle-grad);
				stroke-width: 6;
				stroke-dasharray: 299;
				animation: fillGauge .75s;
			}
			.needle-gauge .percent {
				font-size: 16px;
				font-weight: 500;
				line-height: 20px;
				color: var(--color-blue-selected);
				fill: var(--color-blue-selected);
			}
			.needle-gauge .needle > * {
				fill: var(--color-{{ $colorClass }});

			}
			@keyframes rotateNeedle {
				0% { transform: rotate(-135deg); }
			}
			@keyframes fillGauge {
				0% { stroke-dashoffset: 299; }
			}
		</style>
		<path class="gauge-bg" d="M73.406,73.406C81.47,65.342 86,54.404 86,43C86,19.268 66.732,0 43,0C19.268,0 0,19.268 0,43C0,54.404 4.53,65.342 12.594,73.406L16.717,69.283C9.747,62.312 5.831,52.858 5.831,43C5.831,22.486 22.486,5.831 43,5.831C63.514,5.831 80.169,22.486 80.169,43C80.169,52.858 76.253,62.312 69.283,69.283L73.406,73.406Z" fill="var(--color-body-bg-dark)"/>
		<path xmlns="http://www.w3.org/2000/svg" id="Ticks" d="M42,10L44,10L44,16L42,16L42,10ZM76,42L76,44L70,44L70,42L76,42ZM16,44L16,42L10,42L10,44L16,44ZM65.627,18.959L67.042,20.373L62.799,24.615L61.385,23.201L65.627,18.959ZM24.615,62.799L23.201,61.385L18.959,65.627L20.373,67.042L24.615,62.799ZM67.042,65.627L65.627,67.042L61.385,62.799L62.799,61.385L67.042,65.627ZM23.201,24.615L24.615,23.201L20.373,18.959L18.958,20.373L23.201,24.615Z" fill="var(--color-body-bg-dark)"/>
		<circle xmlns="http://www.w3.org/2000/svg" cx="43" cy="43" r="40" fill="none" class="fill-meter" style="stroke-dashoffset: {{ $filler  }};"/>
		<g class="needle" style="transform: rotate({{ $needle  }}deg);">
			<circle cx="43" cy="43" r="5" />
			<rect x="41" y="36" width="4" height="14" />
			<rect x="42" y="13" width="2" height="32" style="fill-rule:nonzero;"/>
		</g>
		<text class="percent text-monospace" text-anchor="middle" x="43" y="82">{{ round($percent*100) }}%</text>
	</svg>
</div>