@props(['products' => null])

@if( empty($products) )
    <x-wip-widget-full title="Top Selling Items"/>
@else
    @pushonce('css_before:slick')
    <link rel="stylesheet" href="{{ asset('js/plugins/slick-carousel/slick.css') }}"/>
    <link rel="stylesheet" href="{{ asset('js/plugins/slick-carousel/slick-theme.css') }}"/>
    @endpushonce

    @push('css_after')
        <style>
            .slick-slider .slick-arrow {
                background-color: transparent;
            }

            .slick-slider .slick-prev:hover,
            .slick-slider .slick-next:hover {
                background-color: transparent;
            }

            .slick-arrow {
                color: var(--color-dark-blue);
            }

            .slick-prev:hover, .slick-prev:focus,
            .slick-next:hover, .slick-next:focus {
                color: var(--color-blue);
            }

            .slick-arrow::before,
            .slick-arrow::after {
                content: none !important;
            }

            .tsi-block .product-image-slider .slick-slide {
                position: relative;
                padding-top: 32px;
            }

            .tsi-block .product-image-slider .slick-slide .piece-count {
                position: absolute;
                top: 10px;
                right: 75%;
                width: 110px;
                text-align: right;
            }

            .tsi-block .product-image-slider .slick-slide .piece-count .product-count,
            .tsi-block .product-image-slider .slick-slide .piece-count .unit-label {
                color: transparent;
                transition: all .5s;
            }

            .tsi-block .product-image-slider .slick-slide.slick-current .piece-count .product-count {
                color: var(--color-dark);
            }

            .tsi-block .product-image-slider .slick-slide.slick-current .piece-count .unit-label {
                color: var(--color-body-text-dark);
            }
        </style>
    @endpush
    <x-block class="tsi-block block-mode-loading">
        <x-block-header title="Top Selling Items">
            <div class="btn-group align-items-center">
                <span class="text-muted in-header mr-3">Rolling: </span>
                <span class="text-blue in-header font-w500 mr-3" data-period="month">30 days</span>
            </div>
        </x-block-header>
        <x-block-content>
            <div class="js-slider product-image-slider"
                 data-arrows="true"
                 data-slides-to-show="1"
                 data-infinite="true"
                 data-center-mode="true"
                 data-center-padding="40"
                 data-prev-arrow='<button type="button" class="slick-prev"><x-icons.chev-left-16x /></button>'
                 data-next-arrow='<button type="button" class="slick-next"><x-icons.chev-right-16x /></button>'
                 data-as-nav-for=".product-name-slider">
                @foreach( $products as $product )
                    <div>
                        <div class="piece-count">
                            <h4 class="d-inline-block text-monospace m-0 product-count">
                                {{ $product->soldQuantity }}
                            </h4>
                            <span class="ml-1 unit-label font-size-sm">PCS</span>
                        </div>
                        <div class="m-auto" style="width: 141px">
                            <dl>
                                <dt>Product Id</dt>
                                <dd>{{$product->productId}}</dd>
                                <dt>Product number</dt>
                                <dd>{{$product->sku}}</dd>
                                <dt>Product soldRank</dt>
                                <dd>{{$product->soldRank}}</dd>
                            </dl>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-block-content>
        <x-block-footer>
            <div class="d-block w-100">
                <div class="js-slider product-name-slider" data-slides-to-show="1" data-infinite="true"
                     data-as-nav-for=".product-image-slider">
                    @foreach( $products as $product )
                        <div><strong>{{ $product->name }}</strong> - {{ $product->productId }}</div>
                    @endforeach
                </div>
            </div>
        </x-block-footer>
    </x-block>

    @pushonce('js_after:slick')
    <script src="{{ asset('js/plugins/slick-carousel/slick.min.js') }}"></script>
    <script>
        $(function () {
            Dashmix.helpers(['slick']);
        });
    </script>
    @endpushonce

    @push('js_after')
        <script>
            $(function () {
                $('.tsi-block').removeClass('block-mode-loading');
            });
        </script>
    @endpush
@endif
