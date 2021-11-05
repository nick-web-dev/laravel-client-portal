@props(['orders' => null])

@if( !$orders || has_null_props($orders, 'total') )
<x-wip-widget-full title="Today's Orders" />
@else
<x-block href="{{ route('orders') }}" target="_blank">
	<x-block-header title="Today's Orders" class="block-header-light">
		<x-icons.goto-16x class="text-dark link" link="https://oms.staging.boxture.com/users/sign_in"/>
	</x-block-header>
	<x-block-content class="block-content-upper">
		<div class="d-flex orders-block">
			<figure class="digit-display">
				{{ sprintf('%03d', $orders->total) }}
			</figure>
			<div class="vertical-divider"></div>
			<div>
				<figcaption class="text-blue">On Hold</figcaption>
				<div class="font-w500 fs-text-md text-red">{{ sprintf('%02d', $orders->onHold) }}</div>
			</div>
		</div>
	</x-block-content>
	<x-block-content class="px-0 py-0 border-top bg-lighter">
		<x-progress-bar title="Fulfillment Status" :status="$orders->status" />
	</x-block-content>
</x-block>
@endif