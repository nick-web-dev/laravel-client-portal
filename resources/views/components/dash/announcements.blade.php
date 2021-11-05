@props(['items'])

@pushonce('css_before:slick')
    <link rel="stylesheet" href="{{ asset('js/plugins/slick-carousel/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('js/plugins/slick-carousel/slick-theme.css') }}" />
@endpushonce

@push('css_before')
<style>
    .ann-list .slick-prev,
    .ann-list .slick-next {
        bottom: -24px;
        left: auto !important;
        top: auto !important;
        width: 46px !important;
        background: none !important;
    }

    .ann-list .slick-arrow::before,
    .ann-list .slick-arrow::after {
        content: none !important;
    }

    .ann-list.slick-slider .slick-prev {
        right: 50px;
    }
    .ann-list.slick-slider .slick-next {
        right: 15px;
    }
    .ann-list .slick-track {
        display: flex;
    }
    .ann-list .slick-track, .ann-list .slick-list {
        height: 100%;
    }
    .ann-list .title {
        font-size: 18px;
        font-weight: 500;
        line-height: 30px;
        padding: 2px 0;
        max-width: 50%;
        color: #fff;
        background: var(--color-dark-blue);
        box-shadow: 5px 0 0 var(--color-dark-blue),
                   -5px 0 0 var(--color-dark-blue);
    }
    .ann-list .slick-slide {
        position: relative;
        padding: 16px;
        background-position: center center;
        background-size: cover;
    }
    .ann-list [data-toggle="modal"] {
        position: absolute;
        bottom: 16px;
        left: 16px;
    }
</style>
@endpush

<x-block class="justify-content-start announcement-widget block-mode-loading">
    <x-block-header title="Announcements" class="block-header-light">
        {{-- <x-icons.goto-16x class="text-dark" /> --}}
    </x-block-header>
    <x-block-content class="p-0 flex-grow-1">
        <div class="js-slider ann-list h-100 w-100" 
            data-arrows="true" 
            data-slides-to-show="1" 
            data-infinite="true" 
            {{-- data-center-mode="true"  --}}
            data-prev-arrow='<button type="button" class="slick-prev"><x-icons.chev-left-16x color="url(#blue-grad)" /></button>'
            data-next-arrow='<button type="button" class="slick-next"><x-icons.chev-right-16x color="url(#blue-grad)" /></button>' >
            @foreach( $items->sortByDesc('time') as $item )
                <div style="background-image: @if($item->media) url('{{ asset('storage/' . $item->media) }}'),@endif radial-gradient(transparent, #e8f1fd);">
                    <span class="title">{{ ucwords($item->title) }}</span>
                    <a href="#modal-ann-{{ $item->id }}" class="btn btn-default btn-blue" data-toggle="modal" data-id="{{ $item->id }}">Read More</a>
                </div>
            @endforeach
        </div>
    </x-block-content>
    {{-- <x-block-footer /> --}}
</x-block>

@pushonce('js_after:slick')
    <script src="{{ asset('js/plugins/slick-carousel/slick.min.js') }}"></script>
    <script>
        $(function() {
            Dashmix.helpers(['slick']);
            $('.announcement-widget.block-mode-loading').removeClass('block-mode-loading');
        });
    </script>
@endpushonce