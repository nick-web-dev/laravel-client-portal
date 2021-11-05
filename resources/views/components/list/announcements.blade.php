@props(['items', 'demo' => false])

@php 
    if( !isset($items) ){
        $items = collect();
        while( count($items) < 5 ){
            if( $demo ){
                $items->push((object)[
                    'title' => $faker->sentence(5, true),
                    'status' => ['success', 'danger', 'warning'][rand(0,2)],
                    'time' => Carbon\Carbon::parse($faker->dateTimeThisMonth)
                ]);
            } else {
                $items->push((object)[
                    'title' => 'Text',
                    'status' => 'gray',
                    'time' => 'Time'
                ]);
            }
        }
    } else {
        $demo = false;
    }
@endphp

<x-block class="justify-content-start announcement-widget">
    <x-block-header title="Announcements" class="block-header-light">
        <x-icons.goto-16x class="text-dark" />
    </x-block-header>
    <x-block-content class="p-0" data-simplebar>
        <ul class="list-group widget-list list-group-flush">
            @foreach( $items->sortByDesc('time') as $item )
                <li class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal-ann-{{ $item->id }}" data-id="{{ $item->id }}">
                    {{ ucwords($item->title) }}
                    @if( $demo )
                        <span class="indicator-text">{{ $item->time->toFormattedDateString() }}</span>
                    @else
                        <span class="indicator-text">{{ $item->time_elapsed }}</span>
                    @endif
                    <i class="indicator text-danger fa fa-circle"></i>
                </li>
            @endforeach
        </ul>
    </x-block-content>
    {{-- <x-block-footer /> --}}
</x-block>

@push('js_after')
<script>
    $(function(){
        var readAnnouncements = new ReadCache('readAnnouncements');
        $('.announcement-widget .widget-list li').each(function(){
            if( readAnnouncements.has(this.dataset.id) ){
                $(this).find('.fa-circle').removeClass('text-danger').addClass('text-success');
            }
        });
        $('.type-announcement').on('hide.bs.modal', function(){
            if( !readAnnouncements.has(this.dataset.id) ){
                $(`.announcement-widget .widget-list li[data-id=${this.dataset.id}]`).find('.fa-circle').removeClass('text-danger').addClass('text-success');
            }
        });
    });
</script>
@endpush