@props(['size', 'action', 'title', 'image'])

<div {{ $attributes->merge([
    'class' => 'modal', 
    'tabindex' => '-1', 
    'role' => 'dialog', 
    'aria-hidden' => 'true'
]) }} aria-labelledby="{{ $attributes->get('id') }}">
    <div class="modal-dialog {{ $size }}" role="document">
        <div class="modal-content rounded-0">
            <div class="block mb-0">
                <div class="block-header">
                    <h3 class="block-title">{{ $title }}</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option fa-lg" data-dismiss="modal" aria-label="Close">
                            &times;
                        </button>
                    </div>
                </div>

                @if( isset($image) && !empty($image) )
                    <div class="modal-media">
                        <img src="{{ $image }}" alt="" class="img-fluid">
                    </div>
                @endif

                {{ $slot }}


                <div class="block-content block-footer p-0 d-flex">
                    @if( isset($action['link']) && !empty($action['link']) )
                        <button type="button" class="btn btn-xl btn-default flex-grow-1" data-dismiss="modal">Close</button>
                        <a href="{{ $action['link'] }}" class="btn btn-xl btn-dark flex-grow-1" data-dismiss="modal">{{ $action['text'] }}</a>
                    @else
                        <button type="button" class="btn btn-xl btn-dark flex-grow-1" data-dismiss="modal">Done</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>