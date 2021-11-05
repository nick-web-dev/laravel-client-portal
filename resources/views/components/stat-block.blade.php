@props(['icon', 'number', 'label', 'colorClass' => false, 'op' => 10])

<div {{ $attributes->merge(['class' => 'stat-block']) }}>
    <div class="icon {{ $colorClass ? "bg-$colorClass-$op text-$colorClass" : '' }}">
        @isset( $icon )
            @component("components.icons.$icon") @endcomponent
        @else
            <i class="fa fa-2x fa-placeholder"></i>
        @endisset
    </div>
    <div class="text-content">
        <div class="stat-number {{ $colorClass ? "text-$colorClass" : '' }}">
            {{ number_format($number) ?: '000' }}
        </div>
        @isset( $label )
        <div class="stat-label">
            {{ $label }}
        </div>
        @endisset
    </div>
</div>