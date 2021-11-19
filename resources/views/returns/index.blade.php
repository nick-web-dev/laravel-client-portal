@extends('layouts.app')

@section('content')
    <div class="content content-boxed pb-20">
        <h2>Returns Data</h2>
        <div class="widget-container">
            @php([$ordersDataSource, $ordersSeries] = $returns->ordersDataSource())
            <x-returns.orders :dataSource="$ordersDataSource" :series="$ordersSeries"/>
            <x-returns.comparator :orders="$returns->averageReturns['orders']"
                                  :unitsPerOrder="$returns->averageReturns['unitsPerOrder']"/>
            <x-returns.top-items :items="$returns->topReturnedItems"/>
            @php([$returnedUnitsDataSource, $returnedUnitsSeries] = $returns->returnedUnitsDataSource())
            <x-returns.units :dataSource="$returnedUnitsDataSource" :series="$returnedUnitsSeries"/>
            <x-returns.status :value="$returns->returnRate"/>
        </div>
    </div>
@endsection
