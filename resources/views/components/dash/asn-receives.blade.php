@props(['asnReceives' => null])

@if( !$asnReceives || has_null_props($asnReceives, 'pending', 'arrived', 'in_process', 'nonconforming') )
<x-wip-widget-full title="ASNs & Receives" />
@else

@push('css_after')
	<style>
		.grid-2x2 {
			position: relative;
			display: grid;
			grid-template-columns: 1fr 1fr;
			grid-template-rows: 1fr 1fr;
			text-align: center;
		}
		.grid-2x2::before,
		.grid-2x2::after {
			content: '';
			position: absolute;
			border-width: 0;
			border-color: var(--color-body-bg-dark);
			border-style: solid;
		}
		.grid-2x2::before {
			top: 0;
			bottom: 0;
			left: 50%;
			border-left-width: 1px;
		}
		.grid-2x2::after {
			left: 0;
			right: 0;
			top: 50%;
			border-top-width: 1px;
		}

		.grid-2x2 figure {
			display: flex;
			flex-direction: column;
			justify-content: center;
		}
	</style>
@endpush

<x-block href="{{ route('asn-inventory') }}" target="_blank">
	<x-block-header title="ASNs & Receives" class="block-header-light">
		<x-icons.goto-16x class="text-dark link" link="https://owd-demo.corepartners.ru/asn/test/non-conforming-issues"/>
	</x-block-header>
	<x-block-content class="p-0 flex-grow-1 grid-2x2">
		<figure class="digit-display">
			{{ sprintf('%02d', $asnReceives->pending) }}
			<figcaption>Pending</figcaption>
		</figure>
		<figure class="digit-display bg-lighter">
			{{ sprintf('%02d', $asnReceives->arrived) }}
			<figcaption>Arrived</figcaption>
		</figure>
		<figure class="digit-display bg-lighter">
			{{ sprintf('%02d', $asnReceives->in_process) }}
			<figcaption>In Process</figcaption>
		</figure>
		<figure class="digit-display">
			{{ sprintf('%02d', $asnReceives->nonconforming) }}
			<figcaption>Nonconforming</figcaption>
		</figure>
	</x-block-content>
</x-block>
@endif