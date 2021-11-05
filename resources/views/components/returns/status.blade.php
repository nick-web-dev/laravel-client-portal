@props(['value'])

<x-block class="bg-lighter">
	<x-block-header title="Returns Rate">
        <div class="btn-group align-items-center">
            <span class="text-muted in-header mr-3">Rolling: </span>
            <span class="text-blue in-header font-w500 mr-3" data-period="month">30 days</span>
        </div>
    </x-block-header>
	<x-block-content class="align-items-center block-content d-flex flex-column justify-content-end">
		<div class="processing-spinner">
			<div class="value">{{ $value }}%</div>
		</div>
	</x-block-content>
	<x-block-footer class="block-footer-custom" />
</x-block>