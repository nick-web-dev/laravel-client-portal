@props(['title', 'count'])

<header {{ $attributes }}>
    {{ $title }}
    @isset( $count ) <span class="count">{{ $count }}</span> @endisset
</header>