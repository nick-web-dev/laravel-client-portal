@extends('layouts.app')

@section('content')
    <div class="content content-boxed index pb-20">
        <h2>Order Data</h2>
        <div class="widget-container">
            <x-orders.summary :order-summary="$orders->todaySummary" />
            <x-orders.shipped :items="$orders->shippedOrders" />
            <x-orders.by-channel :items="$orders->ordersByChannel" />
            <x-orders.top-selling-items :products="$orders->topSellingItems" />

{{--            <x-orders.by-method :items="$orders->ordersByShipMethod" />--}}
{{--            <x-orders.by-method :items="$orders->shippedOrders" />--}}
{{--            <x-orders.by-method :items="$orders->ordersByMethod ?? null" />--}}
        </div>
    </div>
@endsection
