@props(['items'])

@php
    $items = collect($items);

    /* Temporary for demo: please remove this later */
    $products = [
        ['name'=>'Jacket Skidoo Airbrush','color'=>'Multicolor','amount'=>89,'img'=>'img/shirt.svg'],
        ['name'=>'Parka Coat Kelvin','color'=>'Purple','amount'=>74,'img'=>'img/sample-kelvin.svg'],
        ['name'=>'Jacket Rainforest Pocket','color'=>'Orange','amount'=>38,'img'=>'img/sample-rainforest.svg'],
        ['name'=>'Short jacket Fahrenheit','color'=>'Yellow & Blue','amount'=>32, 'img'=>'img/sample-fahrenheit.svg'],
        ['name'=>'Parka Coat Celsius','color'=>'White & Orange','amount'=>26,'img'=>'img/sample-celsius.svg']
    ];
@endphp

<x-block class="last-5-block block-mode-loading">
    <x-block-header title="Last 5 Cyclecounted Items" class="bg-lighter">
        <x-period-selector class="last-5" />
    </x-block-header>
    <x-block-content data-simplebar class="block-max-scroll simplebar-custom">
        <ul class="list-group widget-list list-group-flush last-5-list">

            {{-- Temporary for demo: please remove this later --}}
            @foreach( $products as $product )
                @php
                    $item = (object) $product;
                @endphp
                <li class="list-group-item list-group-item-action">
                    <div class="image">
                        <img src="{{ $item->img }}" width="30" height="38" />
                    </div>
                    <div class="flex-grow-1 ml-5">
                        <div class="title mb-1">{{ ucwords($item->name) }}</div>
                        <div class="subtitle">{{ $item->color }}</div>
                    </div>
                    <i class="indicator text-gray fa fa-circle"></i>
                    <span class="counter">{{ $item->amount }}%</span>
                    <span class="counter-label">Accurate</span>
                </li>
            @endforeach

        </ul>
    </x-block-content>
    <x-block-footer />
</x-block>

@pushonce('js_after:moment')
    <script src="{{ asset('js/plugins/moment/moment.min.js') }}"></script>
@endpushonce

@push('js_after')
    <script>
        $(function(){
            var data_source = @json( $items->toArray() );

            function listTemplate(args){
                return `
                    <li class="list-group-item list-group-item-action">
                        <div class="image">
                            <img src="${ args.img }" width="21" height="29" />
                        </div>
                        <div class="flex-grow-1 ml-5">
                            <div class="title mb-1">${ args.name }</div>
                            <div class="subtitle">${ args.code }</div>
                        </div>
                        <i class="indicator text-gray fa fa-circle"></i>
                        <span class="counter">${ args.accuracy }%</span>
                        <span class="counter-label">Accurate</span>
                    </li>
                `;
            }

            $('.last-5 [data-period]').on('click', function(){
                $('.last-5-block').addClass('block-mode-loading');
                $('.last-5 [data-period]').removeClass('active');
                $(this).addClass('active');

                let data = data_source.slice(-5);

                $('.last-5-list').html(
                    /* Temporary for demo: commented out for now, please uncomment later */
                    //data.map(item => listTemplate(item)).join('')
                );
                $('.last-5-block').removeClass('block-mode-loading');
            });
            $('.last-5 [data-period="month"]').click();
        });
    </script>
@endpush