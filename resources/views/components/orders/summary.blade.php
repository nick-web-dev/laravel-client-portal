@if( !isset($orderSummary) || is_null($orderSummary) )
<x-wip-widget-full title="Today's Orders" />
@else
<x-block>
    <x-block-header title="Today's Orders" />
    <x-block-content class="d-flex flex-column">
        <div class="row align-items-center">
            <div class="col-6">
                <x-stat-block :number="$orderSummary->posted" label="Posted" icon="posted" color-class="green" />
            </div>
            <div class="col-6">
                <x-stat-block :number="$orderSummary->completed" label="Completed" icon="on-time" color-class="blue" />
            </div>
        </div>
        <div class="flex-grow-1 d-flex flex-column justify-content-center">
            <x-progress-bar class="border py-5" title="Fulfillment Status" status="{{ $orderSummary->fulfillmentStatus }}" />
        </div>
    </x-block-content>
    <x-block-footer class="justify-content-between">
        <span>Carrier Status</span>
        <button type="button" class="btn btn-blue btn-link has-icon">
            <b>Details</b> <x-icons.goto-12x  />
        </button>
    </x-block-footer>
</x-block>
@endif
