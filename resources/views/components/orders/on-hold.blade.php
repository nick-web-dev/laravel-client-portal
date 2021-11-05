@props(['items', 'demo' => false])

@php
    $items = collect( $items );
    $items->transform(function( $order ){
        $order->date = new \Carbon\Carbon($order->date);
        return $order;
    });
@endphp

@if( true )
<x-wip-widget-full title="Orders on Hold" />
@else
<x-block>
    <x-block-header title="Orders on Hold" class="bg-lighter">
        <strong class="text-orange-selected text-monospace">{{ count($items) }}</strong>
    </x-block-header>
    <x-block-content class="p-0">
        <ul class="list-group widget-list list-group-flush">
            @foreach( $items->sortByDesc('time') as $item )
                <li class="list-group-item list-group-item-action">
                    <div>{{ ucwords($item->name) }} - {{ $item->code }}</div>
                    {{-- @if( $demo ) --}}
                        <span class="indicator-text" title="{{ $item->date->format('Y-m-d') }}">
                            {{ $item->date->diffForHumans() }}
                        </span>
                    {{-- @else
                        <span class="indicator-text">{{ $item->date }}</span>
                    @endif --}}
                    <i class="indicator text-gray fa fa-circle"></i>
                </li>
            @endforeach
        </ul>
    </x-block-content>
    <x-block-footer />
</x-block>
@endif