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

<x-block class="returns-comparator" href="https://oms.staging.boxture.com/orders?type=Orders%3A%3AReturnOrder" target="_blank">
	<x-block-header title="Avg. QTY Returned">
        <div class="btn-group align-items-center">
{{--             <span class="mr-4 text-muted">Rolling: </span>
            <button class="btn btn-ghost btn-blue active" data-period="month" type="button">30 days</button> --}}
            <span class="text-muted in-header mr-3">Rolling: </span>
            <span class="text-blue in-header font-w500 mr-3" data-period="month">30 days</span>
        </div>
    </x-block-header>

	<x-block-content class="p-0 flex-grow-1 grid-l-2x2">
		<div class="d-flex justify-content-center align-items-center bg-lighter">
			<div class="item item-circle text-red bg-red-10">
				<x-icons.items-returned />
			</div>
		</div>
		<figure class="digit-display pl-7 bg-lighter">
			{{ $orders }}
			<figcaption>Orders Returned</figcaption>
		</figure>
		<div class="d-flex justify-content-center align-items-center bg-lighter">
			<div class="item item-circle text-yellow bg-yellow-10 bg-lighter ">
				<x-icons.items-returned />
			</div>
		</div>
		<figure class="digit-display pl-7 bg-lighter">
			{{ $unitsPerOrder }}
			<figcaption>Avg. Units Returned Per Order</figcaption>
		</figure>
	</x-block-content>

	<x-block-footer class="block-footer-custom" />
</x-block>
