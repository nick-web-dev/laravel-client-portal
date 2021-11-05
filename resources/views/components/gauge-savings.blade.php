<div {{ $attributes->merge(['class' => 'gauge-savings d-flex justify-content-center align-items-center']) }}>
	<span class="text-light font-w500">${{ number_format($savings, 2) }}</span>
</div>