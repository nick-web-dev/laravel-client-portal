@props(['items', 'label' => ''])

@php
    use Illuminate\View\ComponentAttributeBag as Attributes;

    if(!isset($items)) {
        $items = collect(['Action', 'Action Two', 'Action Three']);
        $items->transform(function($text){
            return (object)[
                'text' => $text,
                'attributes' => [
                    'href' => 'javascript:void(0)',
                    'class' => 'dropdown-item'
                ],
            ];
        });
    }
    $items->transform(function($item){
        return (object)[
            'text' => $item->text,
            'attributes' => (new Attributes(['class' => 'dropdown-item']))->merge($item->attributes),
        ];
    });
@endphp

<div {{ $attributes->merge(['class' => 'dropdown-menu dropdown-no-radius dropdown-custom' ]) }} data-simplebar aria-labelledby="{{ $label }}">
    @foreach($items as $item)
       <a {{ $item->attributes }}>{{ $item->text }}</a>
    @endforeach
</div>


