@props(['items' => null])


@if( true )
<x-wip-widget-full title="Returns by Reason" text="Orders returned with<br> the reason code" />
@else
@php
    $total = $items->count();

    $items = $items->countBy(function($item){
        return $item->reason;
    });
@endphp

<x-block>
    <x-block-header title="Returns by Reason" class="bg-lighter">
        <x-period-selector />
    </x-block-header>
    <x-block-content data-simplebar class="block-max-scroll simplebar-custom">
        <ul class="list-group widget-list list-group-flush">
            @foreach( $items->sortDesc() as $reason => $item )
                <li class="list-group-item list-group-item-action">
                    <div class="flex-grow-1">
                        {{-- <div class="font-w600">{{ ucwords($item->name) }}</div> --}}
                        @if( strlen($reason) <= 45 )
                            <div style="white-space: pre-line;">{{ $reason }}</div>
                        @else
                            <div style="white-space: pre-line;"><span data-text="{{ $reason }}">{{ substr($reason, 0, 45) }}...</span><button class="btn btn-link btn-orange read-more">Read more</button></div>
                        @endif
                    </div>
                    <i class="indicator text-gray fa fa-circle"></i>
                    <span class="counter">{{ sprintf('%02d', $item) }}</span>
                    <span class="counter-label">Returns</span>
                </li>
            @endforeach
        </ul>
    </x-block-content>
    <x-block-footer />
</x-block>

@pushonce('js_after:readMore')
    <script>
        $('.read-more').on('click', function(){
            var $span = $(this).prev('[data-text]');
            var text = $span.html();
            $span.html( $span.data('text') );
            $span.data('text', text);

            if( $(this).text() == 'Read more' ){
                $(this).text('Read less');
            } else {
                $(this).text('Read more');
            }
        });
    </script>
@endpushonce
@endif