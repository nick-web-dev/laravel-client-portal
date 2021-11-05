@props(['title', 'subtitle', 'total', 'tooltip', 'colorClass' => false, 'icon' => null, 'iconColor' => null, 'op' => '20', 'href' => null])

<div {{ $attributes->merge(['class' => 'preview-vertical-card block block-rounded block-bordered ' . ( $colorClass ? "border-$colorClass-20" : '') . (is_null($total) ? ' widget-wip' : '')]) }}>
    @isset($href) <a href="{{$href}}" target="_blank"> @endisset
    <div class="align-items-center {{is_null($total) ? ' bg-wip' : ''}}">
        @isset( $tooltip )
            <div class="icon-corner">
            {{--@if( is_null($total) )
                    <x-icons.data-16x class="flex-shrink-0" color="url(#blue-grad-90)" />
                @else
                    <x-icons.info class="text-blue" alt="Info Icon" data-toggle="tooltip" title="{{ $tooltip }}" data-placement="top" data-custom-class="tooltip-default" />
                @endif --}}
            </div>
        @endisset        

        <div class="d-flex flex-column align-items-center top">
            @if( !is_null($total) )
            <div class="total">
                <span>{{ sprintf('%02d', $total ?? 0) }}</span>
            </div>
            @endif
            <div class="title">
                <span>
                    {{ $title }}
                    @if( is_null($total) )
                        <span class="tag bg-yellow-20 rounded px-4 py-2 ml-2">Data WIP</span>
                    @endif
                </span>
                <p class="subtitle text-muted mt-1 mb-6">{{ $subtitle }}</p>
            </div>
        </div>

        <div class="bottom {{ $colorClass ? "bg-$colorClass-$op" : '' }}">
            <div class="icon item item-circle {{ $colorClass ? "text-$colorClass" : '' }} {{ $colorClass ? "bg-$colorClass-20" : '' }}">            
                @unless($icon)
                    <i class="fa fa-placeholder-circle {{ $colorClass ? "text-$colorClass" : 'text-light' }}"></i>
                @else
                    @component("components.icons.$icon", ['color' => $iconColor]) @endcomponent
                @endunless
            </div>
        </div>
    </div>
    @isset($href) </a> @endisset
</div>
