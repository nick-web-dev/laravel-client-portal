@props(['class', 'color', 'link' => null])

<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="{{ $class ?? '' }}" 
    @isset($link)
        data-url="{{ $link }}"
    @endisset>
<path fill-rule="evenodd" clip-rule="evenodd" d="M16 2V0H14H6L6 2L14 2V10H16V2Z" fill="{{ $color ?? 'currentColor' }}"/>
<path d="M15 1L1 15" stroke="{{ $color ?? 'currentColor' }}" stroke-width="2"/>
</svg>

@isset($link)
    @pushonce('js_after:linkToUrl')
        <script>
            $('.link').on("click", function(e) {
                e.preventDefault()
                e.stopPropagation()
                let url = $(this).data('url')
                if(url !== undefined && url !== null && url !== "") {
                    window.open(url, '_blank')
                }
            })
        </script>
    @endpushonce
@endisset