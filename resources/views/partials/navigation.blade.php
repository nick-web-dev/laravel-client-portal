<header id="page-header" class="pl-0">
    <!-- Header Content -->
    <div class="content-header">
        <!-- Left Section -->
        <div>
            <!-- Toggle Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-sm btn-dual d-inline-block d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <!-- END Toggle Sidebar -->
            <!-- Logo -->
            <a class="font-size-lg text-dual" href="{{ url('/') }}">
                <div id="owd-logo"></div>
            </a>
            {{-- <span class="h6 align-middle text-primary ml-3">{{ $user->subscription }}</span> --}}
            <!-- END Logo -->
        </div>
        <!-- END Left Section -->

        <!-- Middle Section -->
        {{-- <nav class="d-none d-md-flex">
            <a class="btn btn-dual d-none d-sm-flex" href="{{ url('/pages/template') }}">
                Template
            </a>
            <a class="btn btn-dual d-none d-sm-flex" href="/orders">
                Orders
            </a>
            <a class="btn btn-dual d-none d-sm-flex" href="/announcements">
                Announcements
            </a>
            <div class="dropdown d-flex">
                <button type="button" class="btn btn-dual" id="page-header-new-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-none d-sm-inline mr-1">Sub-menu</span>
                    <i class="fa fa-fw fa-chevron-down"></i>
                </button>
                <div class="dropdown-menu p-0" aria-labelledby="page-header-new-dropdown">
                    <div>
                        <a class="dropdown-item" href="javascript:void(0)">
                            <span><i class="fa fa-fw fa-thumbtack mr-1"></i> Post</span>
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                            <span><i class="fa fa-fw fa-camera mr-1"></i> Media</span>
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                            <span><i class="fa fa-fw fa-file mr-1"></i> Page</span>
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                            <span><i class="fa fa-fw fa-user mr-1"></i> User</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav> --}}
        <!-- END Middle Section -->

        <!-- Right Section -->
        <div class="align-items-center d-flex h-100">

            {{-- <button class="btn btn-sm btn-primary py-2 mr-4" onclick="$.toast({
                type: ['','info','danger','success','warning'][Math.floor(Math.random() * 5)],
                title: 'Notice!',
                subtitle: Math.floor(Math.random() * 10) + ' mins ago',
                content: 'Hello, world! This is a toast message.',
                delay: 5000,
                img: {
                    src: 'https://via.placeholder.com/20',
                    class: 'rounded-0', /**  Classes you want to apply separated my a space to modify the image **/
                    alt: 'Image'
                }
            });">Test Small Notification</button> --}}

            @if( $user )
            <nav class="nav" id="nav-tab" role="tablist">
                <x-nav.link id="nav-announcements-tab" href="#nav-announcements" role="tab" aria-controls="nav-announcements" aria-selected="false" icon="bullhorn" />
                <x-nav.link id="nav-notifications-tab" href="#nav-notifications" role="tab" aria-controls="nav-notifications" aria-selected="false" icon="bell" />
            </nav>
            @endif
            
            <!-- User Dropdown -->
            <nav class="nav">
                <button type="button" class="btn btn-ghost-alt {{ $user ? '' : 'hover'}}" id="page-header-user-dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-none d-md-inline-block mr-4">{{ $user->name ?? 'Login' }}</span>
                    <img src="{{ asset('img/profile-logo.svg') }}" alt="">
                </button>
                @include('partials.user-form')
            </nav>
        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->

    <!-- Header Search -->
    <div id="page-header-search" class="overlay-header bg-primary">
        <div class="content-header">
            <form class="w-100" action="/dashboard" method="POST">
                @csrf
                <div class="input-group">
                    <div class="input-group-prepend">
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-primary" data-toggle="layout" data-action="header_search_off">
                            <i class="fa fa-fw fa-times-circle"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control border-0" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                </div>
            </form>
       </div>
    </div>
    <!-- END Header Search -->

    <!-- Header Loader -->
    <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
    <div id="page-header-loader" class="overlay-header bg-primary-darker">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="fa fa-fw fa-2x fa-sun fa-spin text-white"></i>
            </div>
        </div>
    </div>
    <!-- END Header Loader -->
</header>

@push('js_after')
<script>
    var open_tab;
    $('#nav-announcements-tab').click(function(){
        if ( open_tab != 'ann' ) {
            $('#nav-announcements-tab').tab('show');
            Dashmix.layout('side_overlay_open');
            open_tab = 'ann';
        } else {
            Dashmix.layout('side_overlay_close');
            $(this).removeClass('active').attr('aria-selected', false);
            open_tab = null;
        }
    });
    $('#nav-notifications-tab').click(function(){
        if ( open_tab != 'note' ) {
            $('#nav-notifications-tab').tab('show');
            Dashmix.layout('side_overlay_open');
            open_tab = 'note';
        } else {
            Dashmix.layout('side_overlay_close');
            $(this).removeClass('active').attr('aria-selected', false);
            open_tab = null;
        }
    });
</script>
@endpush
