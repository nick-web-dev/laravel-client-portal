@props(['items'])

<x-block class="top-5-block">
    <x-block-header title="Top 5 Items Returned" class="bg-lighter"/>
    <x-block-content data-simplebar class="block-max-scroll simplebar-custom">
        <ul class="list-group widget-list list-group-flush top-5-list">
            @foreach( $items as $item )
                <li class="list-group-item list-group-item-action">
                    <div class="flex-grow-1 ml-5">
                        <div class="title mb-1">{{ ucwords($item['name']) }}</div>
                        <div class="subtitle">{{ $item['productId'] }}</div>
                    </div>
                    <i class="indicator text-gray fa fa-circle"></i>
                    <span class="counter">{{ $item['returnQuantity'] }}</span>
                    <span class="counter-label">Returns</span>
                </li>
            @endforeach
        </ul>
    </x-block-content>
    <x-block-footer/>
</x-block>
