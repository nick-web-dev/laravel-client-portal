@props(['datasource'])

<div {{ $attributes->merge(['class' => 'block block-rounded block-bordered']) }}>
    {{ $slot }}
</div>
{{-- pt-0 d-flex flex-column justify-content-center align-items-center --}}
@pushonce('js_after:chartContainer')
    <script src="{{ asset('js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
@endpushonce
@pushonce('js_after:areaSettings')
    <script src="{{ asset('js/globalAreaSettings.js') }}"></script>
@endpushonce