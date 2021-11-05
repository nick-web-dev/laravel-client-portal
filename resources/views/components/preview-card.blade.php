@props(['title', 'subtitle', 'total', 'tooltip', 'colorClass' => false, 'icon' => null, 'iconColor' => null, 'op' => '20', 'link' => null])

<div {{ $attributes->merge(['class' => 'preview-container' . (is_null($total) ? ' widget-wip' : '')]) }}>
    @if(!is_null($link))
    <a href="{{ $link }}" target="_blank">
    @endif
    <div class="preview-block stat-block p-0 align-items-center {{ $colorClass ? "border-$colorClass-20" : '' }}{{is_null($total) ? ' bg-wip' : ''}}">
        <div class="icon px-4 {{ $colorClass ? "bg-$colorClass-$op" : '' }}">
            <div class="preview-icon {{ $colorClass ? "text-$colorClass-active" : '' }}">
                @unless($icon)
                    <i class="fa fa-placeholder-circle {{ $colorClass ? "text-$colorClass" : 'text-light' }}"></i>
                @else
                    @component("components.icons.$icon", ['color' => $iconColor]) @endcomponent
                @endunless
            </div>
        </div>
        <div class="preview-block-div align-items-center">
            @if( !is_null($total) )
            <div class="figure mt-1 py-3">
                <h1 class="total text-monospace mb-0">{{ sprintf('%02d', $total ?? 0) }}</h1>
            </div>
            @endif
            <div class="text">
                <h5 class="title mb-2">
                    {{ $title }}
                    @if( is_null($total) )
                        <span class="tag bg-yellow-20 rounded px-4 py-2 ml-2">Data WIP</span>
                    @endif
                </h5>
                <p class="subtitle mb-0">{{ $subtitle }}</p>
            </div>
            @isset( $tooltip )
            <div class="icon-corner">
{{--                 @if( is_null($total) )
                    <x-icons.data-16x class="flex-shrink-0" color="url(#blue-grad-90)" />
                @else
                    <x-icons.info class="text-blue" alt="Info Icon" data-toggle="tooltip" title="{{ $tooltip }}" data-placement="top" data-custom-class="tooltip-default" />
                @endif --}}
            </div>
            @endisset
        </div>
    </div>
    @if(!is_null($link))
    </a>
    @endif
</div>