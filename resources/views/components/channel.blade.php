<div class="channel {{ $channel_class }}">
    <div class="top bottom-border-light">
        <span class="subscription-text text-dark-blue-selected">{{ $title }}</span>
        <span class="subscription-logo subscription-logo-light float-right text-dark-blue-selected">
            {{ $channel_name }} Logo
        </span>
    </div>
    <div class="middle-1 d-flex flex-column justify-content-center">
        <span class="subtitle-text text-dark-blue">{{ $subtitle }}</span>
    </div>
    <div class="middle-2">
        @foreach($options as $option=>$option_items)
          @php $channel_id = "collapseDiv-$channel_name-$loop->index"; @endphp
          <div>
            <div class="option-item bg-white"
                 data-toggle="collapse"
                 data-target="#{{ $channel_id }}"
                 aria-expanded="false" 
                 aria-controls="{{ $channel_id }}">
                <span class="body-short-02 text-dark-blue">{{ $option }}</span>
                <div class="float-right">
                  <x-icons.chev-down />
                </div>
            </div>
            <div class="collapse collapse-div" 
                 id="{{ $channel_id }}">
                <div class="collapse-card">
                    @foreach($option_items as $option_item)
                        <div>{{ $option_item }}</div>
                    @endforeach
                </div>
            </div> 
          </div>
         @endforeach
    </div>
    <div class="footer text-right justify-content-end">
        <span class="footer-text text-dark-blue"> {{ $footer }}</span>
        <button type="button" class="btn btn-dark">Primary Button</button>
    </div>
</div>