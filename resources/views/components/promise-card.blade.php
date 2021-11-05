<div {{ $attributes->merge(['class' => "promises-card block block-bordered block-rounded border-$colorClass-20" . ($wip ? ' widget-wip bg-wip' : '')]) }}>
    <div class="block-content block-content-full d-flex justify-content-between">
        <div class="promises-card-icon {{ isset($colorClass) ? "bg-$colorClass-20 text-$colorClass" : '' }}">
            @isset( $icon )
                @component("components.icons.$icon", ['color' => isset($colorClass) ? "url(#$colorClass-grad-90)" : null]) @endcomponent
            @else
                <i class="fa fa-placeholder"></i>
            @endisset
        </div>
        <div class="text-content font-size-sm pl-5 pr-6">
            <h6 class="title">
                {{ $title }}
                @if($wip)
                    <span class="tag bg-yellow-20 rounded px-4">Data WIP</span>
                @endif
            </h6>
            <p class="text">{{ $description }}</p>
        </div>
        @if($wip)
            <x-icons.data-16x class="flex-shrink-0" color="url(#blue-grad-90)" />
        @else
            {{ $slot }}
        @endif
    </div>
</div>