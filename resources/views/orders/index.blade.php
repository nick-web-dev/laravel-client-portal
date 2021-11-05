@extends('layouts.app')

@section('content')
    <div class="content content-boxed index pb-20">
        <h2>Order Data</h2>
        <div class="widget-container">
            <x-orders.summary :order-summary="$order_data->orderSummary ?? null" />

            <x-orders.shipped :items="$order_data->shippedOrders ?? null" />

            {{-- <x-orders.on-hold :items="$order_data->onHold ?? null" /> --}}

            <x-orders.by-channel :items="$order_data->orders ?? null" />

            <x-orders.top-selling-items :products="$order_data->topSellingItems ?? null" />

            <x-orders.by-method :items="$order_data->ordersByMethod ?? null" />
        </div>
    </div>
@endsection