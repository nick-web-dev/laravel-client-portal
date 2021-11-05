@props(['left', 'right', 'title'])

<nav {{ $attributes->merge(['class' => 'nav section-nav']) }}>
	<div>
		@isset( $title ) <h1>{{ $title }}</h1> @endisset
		@isset( $left ) {{ $left }} @endisset
	</div>
	<div>
		@isset( $right ) {{ $right }} @endisset
		@isset( $slot ) {{ $slot }} @endisset
	</div>
</nav>