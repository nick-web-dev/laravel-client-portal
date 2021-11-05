@extends('layouts.app')

@section('content')
    <x-page-upper>
        <h2 class="text-dark-blue-selected">ASNs</h2>
{{--         <div class="row">
            <div class="col-lg-6 col-xl-4">                
                <x-preview-card title="Pending" subtitle="ASNs" :total="$asn->asn_highlights->pending ?? null" color-class="yellow" tooltip="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod." icon="pending-receive" icon-color="url(#yellow-grad-90)" link="https://owd-demo.corepartners.ru/asn/test/asns" />
            </div>
            <div class="col-lg-6 col-xl-4">
                <x-preview-card title="Arrived" subtitle="ASNs" :total="$asn->asn_highlights->arrived ?? null" color-class="green" op="10" tooltip="Text" icon="items-received" icon-color="url(#green-grad-90)" link="https://oms.staging.boxture.com/inventories#sort=available_asc&page=1&page_size=20" />
            </div>
            <div class="col-lg-6 col-xl-4">
                <x-preview-card title="In Process" subtitle="ASNs" :total="$asn->asn_highlights->inProcess ?? null" color-class="blue" tooltip="Text" icon="in-progress" icon-color="url(#blue-grad-90)" />
            </div>
            <div class="col-lg-6 col-xl-4">
                <x-preview-card title="Nonconforming" subtitle="ASNs" :total="$asn->asn_highlights->nonConforming ?? null" color-class="red" op="10" tooltip="Text" icon="shipment-arrived" icon-color="url(#red-grad-90)" link="https://oms.staging.boxture.com/inventories#sort=available_asc&page=1&page_size=20" />
            </div>
        </div> --}}

        <div class="preview-vertical-container">
                <x-preview-vertical-card title="Pending" subtitle="ASNs" :total="$asn->asn_highlights->pending ?? null" color-class="yellow" tooltip="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod." icon="pending-receive" icon-color="url(#yellow-grad-90)" href="https://owd-demo.corepartners.ru/asn/test/asns" />
                <x-preview-vertical-card title="Arrived" subtitle="ASNs" :total="$asn->asn_highlights->arrived ?? null" color-class="green" op="10" tooltip="Text" icon="items-received" icon-color="url(#green-grad-90)" href="https://oms.staging.boxture.com/inventories#sort=available_asc&page=1&page_size=20" />
                <x-preview-vertical-card title="In Process" subtitle="ASNs" :total="$asn->asn_highlights->inProcess ?? null" color-class="blue" tooltip="Text" icon="in-progress" icon-color="url(#blue-grad-90)" />
                <x-preview-vertical-card title="Nonconforming" subtitle="ASNs" :total="$asn->asn_highlights->nonConforming ?? null" color-class="red" op="10" tooltip="Text" icon="shipment-arrived" icon-color="url(#red-grad-90)" href="https://oms.staging.boxture.com/inventories#sort=available_asc&page=1&page_size=20" />
        </div>
    </x-page-upper>

    <div class="content content-boxed pb-20">
        <h2 class="text-dark-blue-selected">Inventory</h2>
        <div class="preview-vertical-container">
                <x-preview-vertical-card title="Low Inventory" subtitle="Items" :total="$inventory->lowInventory" color-class="yellow" op="10" tooltip="Info" icon="low-inventory" href="https://owd-demo.corepartners.ru/asn/test/asns" />
                <x-preview-vertical-card title="Out of Stock" subtitle="Items" :total="$inventory->outOfStock" color-class="red" op="10" tooltip="Info" icon="no-stock" href="https://owd-demo.corepartners.ru/asn/test/non-conforming-issues" />
                <x-preview-vertical-card title="Damaged" subtitle="Items" :total="$inventory->damaged" color-class="orange" op="10" tooltip="Info" icon="damaged" href="https://owd-demo.corepartners.ru/asn/test/asns" />
        </div>
    </div>

    <!-- ASN Data -->
    {{--
    <div class="content content-boxed">
        <div class="widget-container">
            <x-asn-inventory.summary />
            <x-list.non-conforming headerTitle="Non-Conforming" headerNum="10"  />
            <x-asn-inventory.sla-performance />
            <x-asn-inventory.non-conforming headerTitle="Non-Conforming Issues" tooltip="" :items="$asn->nonconforming" headerNum="10" />
        </div>
    </div> --}}

    <!-- Inventory Data -->
    {{--
    <div class="content content-boxed">
        <div class="widget-container">                
            <x-asn-inventory.expiring-prod />
            <x-asn-inventory.aging-inv />
            <x-asn-inventory.last-cyclecount :items="$inventory->cyclecounted" />
        </div>
    </div> --}}
@endsection