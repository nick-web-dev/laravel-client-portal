@props(['items'])

@php
    $items = collect($items);

    // $products_unique = $items->unique('code')->mapWithKeys(function ($item) {
    //     return [$item->code => $item];
    // });

    /* Temporary for demo: please remove this later */
    $products = [
        ['name'=>'Jacket Skidoo Airbrush','color'=>'Multicolor','amount'=>11,'img'=>'img/shirt.svg'],
        ['name'=>'Parka Coat Kelvin','color'=>'Purple','amount'=>8,'img'=>'img/sample-kelvin.svg'],
        ['name'=>'Jacket Rainforest Pocket','color'=>'Orange','amount'=>6,'img'=>'img/sample-rainforest.svg'],
        ['name'=>'Short jacket Fahrenheit','color'=>'Yellow & Blue','amount'=>4, 'img'=>'img/sample-fahrenheit.svg'],
        ['name'=>'Parka Coat Celsius','color'=>'White & Orange','amount'=>3,'img'=>'img/sample-celsius.svg']
    ];

    // $counts = $items->countBy('code');

    // $filtered = $counts->map(function($count, $code) use ($products_unique){
    //     $prod = $products_unique->firstWhere('code', $code);
    //     return (object)[
    //         'name' => $prod->name,
    //         'code' => $prod->code,
    //         'img' => $prod->img,
    //         'amount' => $count
    //     ];
    // });
@endphp

<x-block class="top-5-block block-mode-loading">
    <x-block-header title="Top 5 Items Returned" class="bg-lighter">
        <x-period-selector class="top-5" />
    </x-block-header>
    <x-block-content data-simplebar class="block-max-scroll simplebar-custom">
        <ul class="list-group widget-list list-group-flush top-5-list">
            {{-- @foreach( $filtered->sortByDesc('amount') as $item )
                <li class="list-group-item list-group-item-action">
                    <div class="image">
                        <img src="{{ $item->img }}" width="21" height="29" />
                    </div>
                    <div class="flex-grow-1 ml-5">
                        <div class="title mb-1">{{ ucwords($item->name) }}</div>
                        <div class="subtitle">{{ $item->code }}</div>
                    </div>
                    <i class="indicator text-gray fa fa-circle"></i>
                    <span class="counter">{{ sprintf('%02d', $item->amount) }}</span>
                    <span class="counter-label">Returns</span>
                </li>
            @endforeach --}}

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
                    <span class="counter">{{ $item->amount }}</span>
                    <span class="counter-label">Returns</span>
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
            var products_unique = @json( $products_unique ?? [] );
            var data_source = @json( $items->toArray() ?? [] );

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
                        <span class="counter">${ args.amount }</span>
                        <span class="counter-label">Returns</span>
                    </li>
                `;
            }

            function filterData(period){
                if( period == 'today' ){
                    period = 'day';
                }
                let today = moment();

                let filtered = data_source.filter(item => {
                    let date_obj = moment(item.date);
                    return today.isSame(date_obj, period);
                });

                let counts = {};
                filtered.forEach(item => {
                    if( counts[item.code] == undefined ){
                        counts[item.code] = 0;
                    } 
                    counts[item.code]++;
                });

                let counted = [];

                for(let code in counts) {
                    let prod = products_unique[code];
                    counted.push({
                        img: prod.img,
                        name: prod.name,
                        code: code,
                        amount: counts[code]
                    });
                }

                counted = counted.sort((a, b) => b.amount - a.amount);
                return counted.slice(0,5);
            }

            $('.top-5 [data-period]').on('click', function(){
                $('.top-5-block').addClass('block-mode-loading');
                $('.top-5 [data-period]').removeClass('active');
                $(this).addClass('active');

                // let data = filterData($(this).data('period'));

                $('.top-5-list').html(
                    /* Temporary for demo: commented out for now, please uncomment later */
                    //data.map(item => listTemplate(item)).join('')
                );
                $('.top-5-block').removeClass('block-mode-loading');
            });
            $('.top-5 [data-period="month"]').click();
        });
    </script>
@endpush