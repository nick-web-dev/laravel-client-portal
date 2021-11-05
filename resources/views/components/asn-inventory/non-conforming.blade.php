@props(['headerTitle', 'headerNum', 'tooltip', 'items'])

@php 
    $items = collect($items);
@endphp

@if( !isset($items) || !$items->count() )
<x-wip-widget-full :title="$headerTitle" />
@else
<x-block class="block-full-height">
    <x-block-header :title="$headerTitle" class="bg-lighter list-header">
        @isset($tooltip)
            <x-slot name="title">
                {{ $headerTitle }}{{-- <x-icons.info class="text-blue ml-3" data-toggle="tooltip" data-custom-class="tooltip-default" title="{{ $tooltip }}" /> --}}
            </x-slot>
        @endisset
        <div class="text-monospace ml-auto header-num">{{ $headerNum }}</div>
    </x-block-header>
    <x-block-content data-simplebar class="block-max-scroll">        
        <ul class="list-group widget-list list-group-flush">
            @foreach($items as $item)
                <li class="list-group-item list-group-item-action pb-3">
                    <div>
                        <h6 class="title mb-1">{{ $item->name }}</h6>
                        <div class="subtitle">{{ $item->code }}</div>
                    </div>
                    <i class="indicator {{ $item->indicator_status }} fa fa-circle"></i>
                    <span class="counter">{{ $item->counter }}</span>
                    <div class="indicator-text mb-2">
                        {{ $item->date ?? $item->indicator_text ?? '' }}
                    </div>
                </li>
            @endforeach
        </ul>
    </x-block-content>
    <x-block-footer />
</x-block>
@endif