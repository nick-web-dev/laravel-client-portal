@props(['text' => null, 'textClass' => null, 'icon', 'iconColor' => null])

<a {{ $attributes->merge(['class' => 'btn nav-item nav-link btn-ghost']) }}>
	@if( isset( $text ) || isset( $icon ) ) 
		@isset( $icon )
			@isset( $text ) <span class="mr-block {{ $textClass }}">{{ $text }}</span> @endisset
			@component("components.icons.$icon", ['color' => $iconColor ? "url(#$iconColor-grad-90)" : null]) @endcomponent
		@else
			{{ $text }}
		@endisset
	@endif
	{{ $slot }}
</a>