@if( false)
<x-wip-widget-full title="SLA Performance" />
@else
<x-block class="sla-perf-block block-mode-loading">
    <x-block-header title="SLA Performance">
        <x-period-selector class="sla" />
    </x-block-header>
    <x-block-content class="flex-grow-1 d-flex flex-column justify-content-center pt-0">
        <x-pie-chart :percent="51.2" color-class="blue" text-color="blue-selected" class="gauge align-middle" size="200" track-width="14" />
    </x-block-content>
    <x-block-footer />
</x-block>

@push('js_after')
    <script>
        $(function(){
            $('.sla [data-period]').click(function(){
                $('.sla [data-period]').removeClass('active');
                $(this).addClass('active');

                let percents = {
                    today: 90,
                    month: 95,
                    quarter: 98.3,
                    year: 99.4
                };

                $('.sla-perf-block .pie-chart').data('easyPieChart').update( 
                    percents[ this.dataset.period ] 
                );
                $('.sla-perf-block .pie-chart .fs-text-md').html(
                    percents[ this.dataset.period ] + '%'
                );
            });
            $('.sla [data-period="month"]').click();
            $('.sla-perf-block').removeClass('block-mode-loading');
        });
    </script>
@endpush
@endif