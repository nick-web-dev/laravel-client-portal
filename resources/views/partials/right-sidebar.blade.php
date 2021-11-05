<aside id="side-overlay">
    <!-- Side Header - Close Side Overlay -->
    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
    {{-- <a class="content-header bg-body-dark justify-content-center text-danger" data-toggle="layout" data-action="side_overlay_close" href="javascript:void(0)">
        <i class="fa fa-2x fa-times-circle"></i>
    </a> --}}
    <!-- END Side Header - Close Side Overlay -->

    <!-- Side Content -->
    <div id="nav-tabContent" class="tab-content">
        <!-- Announcements -->
        <div class="tab-pane fade pb-20" id="nav-announcements" role="tabpanel" aria-labelledby="nav-announcements-tab">
            <div class="tab-title">
                Announcements
            </div>
            
            @if( $announcements_list->count() )
                <x-sidebar.header title="New" :count="$announcements_list->count()" class="title-ann-new" />

                @foreach( $announcements_list as $index => $announcement )
                    <a href="#modal-ann-{{ $announcement->id }}" class="announcement new d-block border-top py-5 px-block" data-toggle="modal" data-id="{{ $announcement->id }}">
                        <i class="fa fa-circle text-danger"></i>
                        <div class="d-flex justify-content-between">
                            <div class="pl-0 mr-block thumbnail" style="background-image: url('{{ asset('storage/' . $announcement->media) }}');">
                            </div>
                            <span class="m-0 mr-2">
                                {{ $announcement->title }}<br>
                                <small class="text-muted">{{ $announcement->time_elapsed }}</small>
                            </span>
                        </div>
                    </a>
                @endforeach


                <div class="announcements-read">
                    <x-sidebar.header title="Old" :count="0"  class="title-ann-old" />
                </div>
            @endif

            @unless( $announcements_list->count() )
                <div class="aspect-ratio-16-9 text-center">
                    <i class="fa fa-lg fa-bullhorn mt-10 mb-6" style="transform: rotate(-35deg);"></i>
                    <p>No Announcements <br>at This Moment</p>
                </div>
            @endunless

        </div>
        <!-- END Announcements -->

        <!-- Notifications -->
        <div class="tab-pane fade" id="nav-notifications" role="tabpanel" aria-labelledby="nav-notifications-tab">
            <div class="tab-title">
                Notifications
            </div>
            <x-sidebar.header title="Newest" :count="$notifications->count()" class="title-newest"/>
            @forelse( $notifications as $notification )
                <a href="#modal-note-{{ $notification->id }}" class="notification d-block border-top p-4 pr-block" data-toggle="modal" data-id="{{ $notification->id }}">
                    <i class="fa fa-circle text-danger"></i>
                    <div class="d-flex justify-content-between">
                        @if( false && $notification->media )
                            <div class="thumbnail pl-0 mr-3">
                                <div class="aspect-ratio-1-1 rounded-circle" style="background: url('{{ asset('storage/' . $notification->media) }}') center center no-repeat var(--color-body-bg-dark, #ddd)"></div>
                            </div>
                        @endif
                        <span class="m-0 mr-3 flex-grow-1">
                            <strong class="text-dark-blue-selected">Notification Type</strong> {{ $notification->title }}<br>
                            <small class="text-muted">{{ $notification->time_elapsed }}</small>
                        </span>
                    </div>
                </a>
            @empty
                <div class="aspect-ratio-16-9 text-center">
                    <i class="fa fa-lg fa-bell mt-10 mb-6"></i>
                    <p>No Notifications <br>at This Moment</p>
                    <div class="px-7">
                        <p><small>Lorem, ipsum dolor sit amet, consectetur adipisicing elit. Eveniet eaque et sed ullam qui laborum veniam, non eum, officia ad!</small></p>
                    </div>
                </div>
            @endif

            
            <div class="notifications-read">
                <x-sidebar.header title="Read" :count="0" class="title-read" />
            </div>
        </div>
        <!-- END Notifications -->
    </div>
    <!-- END Side Content -->
</aside>

@foreach( $announcements_list as $ann )
    <x-announcement-modal id="modal-ann-{{ $ann->id }}" :announcement="$ann" type="announcement"  :data-id="$ann->id"/>
@endforeach

@foreach( $notifications as $note )
    <x-announcement-modal id="modal-note-{{ $note->id }}" :announcement="$note" type="notification" :data-id="$note->id" />
@endforeach