@props(['title', 'tooltip' => null])

<div {{ $attributes->merge(['class' => 'block-header']) }}>
	@isset($title)<h3 class="block-title">{{ $title }} 
		{{-- @if( $tooltip ) <x-icons.info class="text-blue ml-2" width="18" height="18" data-toggle="tooltip" data-custom-class="tooltip-default" title="{{ $tooltip }}" /> @endif --}}</h3>@endisset
	@isset($slot)<div class="block-options">{{ $slot }}</div>@endisset
</div>