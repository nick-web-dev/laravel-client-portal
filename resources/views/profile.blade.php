@extends('layouts.app')

@push('js_after')
    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/profile.js') }}"></script>
@endpush

@section('content')
<div class="mx-auto profile-container">
    <div class="profile-container-top">
        <div class="user-info-div">
            <div class="mx-auto brand-logo"> 
                <img src="{{ $user->pfp }}" class="rounded-circle"/>
            </div>
            <div class="text-right button-div">
                <button type="button" class="btn btn-alt btn-blue has-icon body-short-02 hover">
                    <span>Log-out</span>
                    <i class="fa fa-placeholder fa-sm"></i>
                </button> 
            </div>
            <div class="title text-center">{{ $user->company }}</div>
            <div class="email body-short-02 text-center"><span class="text-dark-blue">{{ $user->email }}</span></div>
            <div class="role text-center">{{ $user->role }}</div>
        </div>
{{--         @if($user->subscription != "OWDRep")
            <div class="d-flex justify-content-between align-items-center key-div-container left-border border-orange-20">
                <div class="key-div top-border-light bottom-border-light body-short-02"
                        data-target="#collapseDiv-key"
                        data-toggle="collapse"
                        aria-expanded="false" 
                        aria-controls="collapseDiv">
                    <div class="d-inline-flex align-items-center">
                        <span class="text-dark-blue-selected">My Keys</span>
                    </div>
					<span class="btn btn-ghost btn-dark-blue btn-lg px-5 float-right">
                        <x-icons.chev-down />
					</span>
                </div>
            </div>            
            <div class="collapse border-left border-direct border-4x bg-light-blue-active" id="collapseDiv-key">
                <div class="collapsible-container row">
                    <div class="col-md-6">
                        <label for="shopify-merchant-id-input"><span class="text-dark-blue">Shopify Merchant ID</span></label>
                        <x-icons.info class="text-blue ml-2 mb-1" width="18" height="18" data-toggle="tooltip" data-custom-class="tooltip-default" title="Test" />
                        <div class="border-bottom border-dark-blue bg-white input-group">
                            <input type="text" class="form-control"
                                    id="shopify-merchant-id"
                                    value="{{ $user->shopifyMerchantId }}"/>
                            <div class="input-group-append text-dark">
                                <button class="btn btn-dark-blue btn-ghost btn-lg px-5" type="button">
                                    <x-icons.goto-16x />
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="api-subkey-input text-dark-blue">API Sub Key</label>
                        <x-icons.info class="text-blue ml-2 mb-1" width="18" height="18" data-toggle="tooltip" data-custom-class="tooltip-default" title="Test" />
                        <div class="border-bottom border-dark-blue bg-white input-group">
                            <input type="text" class="form-control"
                                    id="api-subkey-input"
                                    value="{{ $user->apiSubKey }}"/>
                            <div class="input-group-append text-dark">
                                <button class="btn btn-dark-blue btn-ghost btn-lg px-5" type="button">
                                    <x-icons.copy-16x />
                                </button>
                                <button class="btn btn-dark-blue btn-ghost btn-lg px-5" type="button">
                                    <x-icons.goto-16x />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="subscription-div left-border border-direct">
                <div class="d-inline-block">
                    <div class="subscription-text"><span class="text-dark-blue-selected">Your Subscription</span></div>
                    <div class="profile-text-muted">Since: {{ $user->dateJoined }} </div>
                </div>
                <span class="subscription-logo subscription-logo-dark float-right ">
                    {{ $user->subscription }} Logo
                </span>
            </div>
        @endif --}}
    </div>
{{--     @if($user->subscription != "Global")
        <div class="profile-container-middle">
            <span class="text-dark-blue-selected">Upgrade</span>
        </div>
        <div class="profile-container-bottom">
            @subscription( "EasyOrder" )
                @component('components.channel', 
                            ["channel_class" => "subscription-div-omnifill",
                            "channel_name" => "OmniFill",
                            "title" => "Scale with OmniFill",
                            "subtitle" => "For Omni-Channel Merchants Who need it all",
                            "footer" => "Scale with our Omni Services subscribe now",
                            "options" => ["International Fullfillment" => ["Text 1","Text 2", "Text 3"], 
                                        "U.S. Fullfillment" => ["Dummy 1","Dummy 2"], 
                                        "Return Services" => ["Text 1","Text 2", "Text 3"], 
                                        "Contact Center" => ["Dummy 1","Dummy 2","Dummy 3"], 
                                        "Virtual Assistants" => ["Text 1","Text 2", "Text 3"]]])
                @endcomponent
            @endsubscription
            @component('components.channel', 
                        ["channel_class" => "subscription-div-global",
                        "channel_name" => "Global",
                        "title" => "Ready to go Global?",
                        "subtitle" => "When you're in need of a complete global fulfillment solution",
                        "footer" => "Grow with our Global subscription now",
                        "options" => ["Everything in Enterprise +" => ["Text 1","Text 2", "Text 3"],
                                    "VAT compliance" => ["Dummy 1","Dummy 2"], 
                                    "Customs navigation" => ["Text 1","Text 2", "Text 3"], 
                                    "Custom navigation" => ["Dummy 1","Dummy 2","Dummy 3"],
                                    "European fulfillment center" => ["Text 1","Text 2", "Text 3"]]])
            @endcomponent
        </div>
    @endif --}}
</div>
@endsection