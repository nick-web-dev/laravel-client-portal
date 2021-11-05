@extends('layouts.app')

@section('content')
	<div class="content content-boxed pb-20">
		<h2>Returns Data</h2>
		<div class="widget-container">
			<x-returns.orders :items="$return_data->returnedOrders" />

			<x-returns.comparator :items="$return_data->returnedOrders" />

			<x-returns.top-items :items="$return_data->returnedUnits" />

			<x-returns.units :items="$return_data->returnedUnits" />

			@php
				// $pending_count = collect($return_data->returnedUnits)->where('status', 'pending')->count();
			@endphp
			<x-returns.status :value="$return_data->returnRate" />

			{{-- <x-returns.by-reason :items="$return_data->returnedUnits" /> --}}
		</div>
	</div>
@endsection
