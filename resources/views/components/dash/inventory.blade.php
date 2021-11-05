@props(['inventory' => null])

@if( !$inventory || has_null_props($inventory, 'outOfStock', 'lowInventory') )
<x-wip-widget-full title="Inventory" />
@else
@push('css_after')
	<style>
		.grid-l-2x2 {
			position: relative;
			display: grid;
			grid-template-columns: 80px 1fr;
			grid-template-rows: 1fr 1fr;
			text-align: left;
		}
		.grid-l-2x2::before,
		.grid-l-2x2::after {
			content: '';
			position: absolute;
			border-width: 0;
			border-color: var(--color-body-bg-dark);
			border-style: solid;
		}
		.grid-l-2x2::before {
			top: 0;
			bottom: 0;
			left: 80px;
			border-left-width: 1px;
		}
		.grid-l-2x2::after {
			left: 0;
			right: 0;
			top: 50%;
			border-top-width: 1px;
		}

		.grid-l-2x2 figure {
			display: flex;
			flex-direction: column;
			justify-content: center;
		}
	</style>
@endpush

<x-block href="{{ route('asn-inventory') }}" target="_blank">
	<x-block-header title="Inventory" class="block-header-light">
		<x-icons.goto-16x class="text-dark link" link="https://owd-demo.corepartners.ru/asn/test/non-conforming-issues"/>
	</x-block-header>
	<x-block-content class="p-0 flex-grow-1 grid-l-2x2">
		<div class="d-flex justify-content-center bg-lighter">
			<div class="item item-circle text-red bg-red-10">
				<x-icons.no-stock />
			</div>
		</div>
		<figure class="digit-display pl-7">
			{{ sprintf('%02d', $inventory->outOfStock) }}
			<figcaption>Out of Stock</figcaption>
		</figure>
		<div class="d-flex justify-content-center bg-lighter">
			<div class="item item-circle text-yellow bg-yellow-10 bg-lighter ">
				<x-icons.low-inventory />
			</div>
		</div>
		<figure class="digit-display pl-7">
			{{ sprintf('%02d', $inventory->lowInventory) }}
			<figcaption>Low Inventory</figcaption>
		</figure>
	</x-block-content>
</x-block>
@endif