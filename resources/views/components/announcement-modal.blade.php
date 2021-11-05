@props(['announcement', 'type' => 'announcement'])

<div {{ $attributes->merge([
    'class' => "modal announcement-modal type-$type", 
    'tabindex' => '-1', 
    'role' => 'dialog', 
    'aria-hidden' => 'true'
]) }} aria-labelledby="{{ $attributes->get('id') }}">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content rounded-0">
            <div class="block mb-0">
                <div class="block-header clearfix">
                    @if( $type == 'notification' )
                        <div class="thumbnail aspect-ratio-1-1 rounded-circle" style="background: url('{{ asset('storage/' . $announcement->media) }}') center center no-repeat var(--color-body-bg-dark, #ddd)"></div>
                    @endif
                    <div class="header-top">
                        <h3 class="block-title">{{ $announcement->title }}</h3>
                        <div class="block-options">
                            <a href="javascript:void(0)" class="text-blue" data-dismiss="modal" aria-label="Close">
                                <x-icons.close-16x />
                            </a>
                        </div>
                    </div>
                    <div class="block-meta">
                        <span class="author">{{ $announcement->author }}</span>
                        <span class="time-elapsed">{{ $announcement->timeElapsed }}</span>
                    </div>
                </div>

                @if( !empty($announcement->media) && $type != 'notification' )
                    <div class="modal-media">
                        <img src="/storage/{{ $announcement->media }}" alt="" class="d-block img-fluid mx-auto">
                    </div>
                @endif

                <x-block-content class="bg-lighter text-dark prev-content">
                    {!! $announcement->render() !!}
                </x-block-content>

                <div class="block-content block-footer p-0 d-flex">
                    {{-- @if( !empty($announcement->action_link) )
                        <button type="button" class="btn btn-default btn-xl flex-grow-1" data-dismiss="modal">Close</button>
                        <a href="{{ $announcement->action_link }}" class="btn btn-dark btn-xl flex-grow-1" data-dismiss="modal">{{ $announcement->action_text }}</a>
                    @else --}}
                        <button type="button" class="btn btn-default btn-blue btn-xl flex-grow-1" data-dismiss="modal">Done</button>
                    {{-- @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>