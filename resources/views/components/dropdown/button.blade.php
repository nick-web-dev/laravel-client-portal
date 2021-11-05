@props(['title' => 'Text', 'alt' => false])

<button type="button" {{ $attributes->merge(['class' => 'btn btn-ghost'.($alt ? '-alt' : '').' btn-sm has-icon']) }} data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {{ $title }}
    <x-icons.caret />
</button>
