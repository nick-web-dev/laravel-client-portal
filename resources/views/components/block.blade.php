@unless( isset($href) )
<div {{ $attributes->merge(['class' => 'block block-rounded block-bordered']) }}>
    {{ $slot }}
</div>
@else
<a {{ $attributes->merge(['class' => 'block block-rounded block-bordered']) }}>
    {{ $slot }}
</a>
@endunless