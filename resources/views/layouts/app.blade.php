<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        @include('partials.head')
    </head>
    <body>
        <!-- Page Container -->
        {{--
            Available classes for #page-container:

        GENERIC

            'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Template._uiHandleTheme())

        SIDEBAR & SIDE OVERLAY

            'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
            'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
            'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
            'sidebar-dark'                              Dark themed sidebar

            'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
            'side-overlay-o'                            Visible Side Overlay by default

            'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

            'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

        HEADER

            ''                                          Static Header if no class is added
            'page-header-fixed'                         Fixed Header


        Footer

            ''                                          Static Footer if no class is added
            'page-footer-fixed'                         Fixed Footer (please have in mind that the footer has a specific height when is fixed)

        HEADER STYLE

            ''                                          Classic Header style if no class is added
            'page-header-dark'                          Dark themed Header
            'page-header-glass'                         Light themed Header with transparency by default
                                                        (absolute position, perfect for light images underneath - solid light background on scroll if the Header is also set as fixed)
            'page-header-glass page-header-dark'         Dark themed Header with transparency by default
                                                        (absolute position, perfect for dark images underneath - solid dark background on scroll if the Header is also set as fixed)

        MAIN CONTENT LAYOUT

            ''                                          Full width Main Content if no class is added
            'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
            'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
        --}}
        <div id="page-container" class="sidebar-o sidebar-dark sidebar-mini side-scroll page-header-fixed">

            <!-- Side Overlay-->
            @if( $user )
            @include('partials.right-sidebar')
            @endif
            <!-- END Side Overlay -->

            <!-- Sidebar -->
            @include('partials.left-sidebar')
            <script>
                var sidebar_state = localStorage.getItem('sidebar_state') || 'mini';
                if( sidebar_state != 'mini' || window.innerWidth < 1024 ){
                    document.querySelector('#page-container').classList.remove('sidebar-mini');
                    document.querySelector('.expand-icon').style.display = 'none';
                } else {
                    document.querySelector('.collapse-icon').style.display = 'none';
                }
            </script>
            <!-- END Sidebar -->

            <!-- Header -->
            @include('partials.navigation')
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">
                @yield('content')
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            @hasSection('footer')
                <footer id="page-footer">
                    @yield('footer')
                </footer>
            @endif
            {{-- @include('partials.footer') --}}
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <!-- Dashmix Core JS -->
        <script src="{{ mix('js/dashmix.app.js') }}"></script>
        <script src="{{ asset('js/plugins/jquery-toast/toast.js') }}"></script>
        <script src="{{ asset('js/devex/dx.all.js') }}"></script>

        <script>
            if( sidebar_state == 'mini' ){
                generateTooltips();
            }

            var tooltips_generated = false;
            function generateTooltips(){
                $('#sidebar .nav-main-link').each(function(i, el){
                    el = $(el);
                    el.attr('title', el.find('.nav-main-link-name').text()).tooltip({
                        placement: 'right',
                        container: 'body',
                        boundary: 'viewport'
                    });
                });
                tooltips_generated = true;
            }

            class ReadCache {
                constructor(key){
                    this.name = key;
                    this.items = JSON.parse( localStorage.getItem(key) ) || [];
                    this.clearOld();
                }
                save() {
                    this.clearNulls();
                    localStorage.setItem(this.name, JSON.stringify( this.items ));
                }
                has(id){
                    return this.items.some((item) => item.id == id);
                }
                clearOld(){
                    let cacheTime = 1000 * 60 * 60 * 24 * 14; // two weeks
                    this.items.forEach(function(item, i){
                        if( item && (new Date).getTime() - item.timestamp > cacheTime ){
                            delete this.items[i];
                        }
                    }.bind(this));
                    this.clearNulls();
                }
                clearNulls(){
                    this.items = this.items.filter((item) => item);
                }
            }

            $(function(){
                window.addEventListener('resize', function(){
                    if( window.innerWidth < 1024 && $('#page-container').hasClass('sidebar-mini') ){
                        $('#sidebar .nav-main-link').tooltip('disable');
                        localStorage.sidebar_state = 'full';
                        Dashmix.layout('sidebar_mini_off');
                    }
                });

                $('[data-action="sidebar_mini_toggle"]').click(function(){
                    // if it has the class, then the toggle is about to turn it off!
                    if( $('#page-container').hasClass('sidebar-mini') || window.innerWidth < 1024 ){
                        $('#sidebar .nav-main-link').tooltip('disable');
                        localStorage.sidebar_state = 'full';
                    } else {
                        if( !tooltips_generated ){
                            generateTooltips();
                        } else {
                            $('#sidebar .nav-main-link').tooltip('enable');
                        }
                        localStorage.sidebar_state = 'mini';
                    }
                    $('.collapse-icon, .expand-icon').toggle();
                });

                var readAnnouncements = new ReadCache('readAnnouncements');
                var readNotifications = new ReadCache('readNotifications');

                $('a.announcement').each(function(){
                    if( readAnnouncements.has(this.dataset.id) ){
                        $(this).find('.fa-circle').removeClass('text-danger').addClass('text-success');
                        $(this).appendTo( $('.announcements-read') );
                        changeReadCount('nav-announcements', 'title-ann-new', 'title-ann-old');
                    }
                });

                $('.type-announcement').on('hide.bs.modal', function(){
                    if( !readAnnouncements.has(this.dataset.id) ){
                        $(`a.announcement[data-id=${this.dataset.id}]`).find('.fa-circle').removeClass('text-danger').addClass('text-success');

                        $(`a.announcement[data-id="${this.dataset.id}"]`).appendTo( $('.announcements-read') );
                        changeReadCount('nav-announcements', 'title-ann-new', 'title-ann-old');

                        readAnnouncements.items.push({
                            id: this.dataset.id,
                            timestamp: (new Date).getTime()
                        });
                        readAnnouncements.save();
                    }
                });


                $('a.notification').each(function(){
                    if( readNotifications.has(this.dataset.id) ){
                        $(this).find('.fa-circle').removeClass('text-danger').addClass('text-success');
                        $(this).appendTo( $('.notifications-read') );
                        changeReadCount('nav-notifications', 'title-newest', 'title-read');
                    }
                });

                $('.type-notification').on('hide.bs.modal', function(){
                    if( $(`.notifications-read a.notification[data-id="${this.dataset.id}"]`).length ){
                       return; 
                    }

                    $(`a.notification[data-id="${this.dataset.id}"]`).appendTo( $('.notifications-read') );
                    changeReadCount('nav-notifications', 'title-newest', 'title-read');

                    readNotifications.items.push({
                        id: this.dataset.id,
                        timestamp: (new Date).getTime()
                    });
                    readNotifications.save();
                });

                function changeReadCount(key, titleNew, titleOld) {

                    var $newest = $('#' + key + ' .' + titleNew + ' .count'),
                        $read = $('#' + key + ' .' + titleOld + ' .count');
                    var newCount = Number($newest.text()),
                        readCount = Number($read.text());

                    if( newCount - 1 <= 0 ){
                        $newest.parent().hide();
                    }

                    $newest.text( newCount-1 );
                    $read.text( readCount+1 );
                }
            });
        </script>

        @php
            $palette = collect(['yellow', 'orange', 'red', 'green', 'blue', 'dark-blue']);
        @endphp

        <svg height="0" width="0">
        <defs>
            @foreach( $palette as $color )
                <lineargradient id="{{ $color }}-grad" x1="0%" x2="0%" y1="0%" y2="100%">
                    <stop offset="0%" stop-color="var(--color-{{ $color }}-passive)" stop-opacity="1"></stop>
                    <stop offset="100%" stop-color="var(--color-{{ $color }}-selected)" stop-opacity="1"></stop>
                </lineargradient>
                <lineargradient id="{{ $color }}-grad-90" x1="0%" x2="100%" y1="0%" y2="0%">
                    <stop offset="0%" stop-color="var(--color-{{ $color }}-passive)" stop-opacity="1"></stop>
                    <stop offset="100%" stop-color="var(--color-{{ $color }}-selected)" stop-opacity="1"></stop>
                </lineargradient>
                <lineargradient id="{{ $color }}-grad-1" x1="0%" x2="0%" y1="0%" y2="100%">
                    <stop offset="0%" stop-color="var(--color-{{ $color }})" stop-opacity="0.3"></stop>
                    <stop offset="100%" stop-color="var(--color-{{ $color }})" stop-opacity="0.9"></stop>
                </lineargradient>
                <lineargradient id="{{ $color }}-grad-2" x1="0%" x2="0%" y1="0%" y2="100%">
                    <stop offset="0%" stop-color="var(--color-{{ $color }})" stop-opacity="0.1"></stop>
                    <stop offset="100%" stop-color="var(--color-{{ $color }})" stop-opacity="0.2"></stop>
                </lineargradient>
                <lineargradient id="{{ $color }}-grad-3" x1="0%" x2="0%" y1="0%" y2="100%">
                    <stop offset="0%" stop-color="var(--color-{{ $color }})" stop-opacity="0"></stop>
                    <stop offset="100%" stop-color="var(--color-{{ $color }})" stop-opacity="0.1"></stop>
                </lineargradient>
            @endforeach
        </defs>
        </svg>
        <script>
            class Palette {
                constructor(colors){
                    this.colors = this.initialColors = colors;
                    this.index = 0;
                    this.gradIter = 1;
                }
                shuffle(){
                    for (let i = this.colors.length - 1; i > 0; i--) {
                        const j = Math.floor(Math.random() * (i + 1));
                        const temp = this.colors[i];
                        this.colors[i] = this.colors[j];
                        this.colors[j] = temp;
                    }
                    this.index = 0;
                    this.gradIter = 1;
                }
                next(){
                    this.index++;
                    this.gradIter++;
                    if( this.index >= this.colors.length ){
                        this.index = 0;
                    }
                    return this;
                }
                currentSolid(variant){
                    variant = (variant ? `-${variant}` : '');
                    return `var(--color-${this.colors[this.index]}${variant})`;
                }
                currentGradient(grad){
                    let gradIter = grad ?? (this.gradIter > 3 ? 3 : this.gradIter);
                    return `url(#${this.colors[this.index]}-grad-${gradIter})`;
                }
                applySeriesColors(series){
                    this.gradIter = 1;
                    series.forEach((item, i) => {
                        $.extend(true, series[i], {
                            /* this will give us the most transparent grad until we get to the front */
                            color: this.currentGradient( 3 ),
                            border: { color: this.currentSolid() },
                            point: {
                                border: { color: this.currentSolid() },
                                hoverStyle: {
                                    border: { color: this.currentSolid('active') },
                                },
                                selectionStyle: {
                                    border: { color: this.currentSolid('selected') },
                                }
                            },
                            hoverStyle: {
                                color: this.currentGradient( 2 ),
                                border: { color: this.currentSolid('active') },
                            },
                            selectionStyle: {
                                color: this.currentGradient( 1 ),
                                border: { color: this.currentSolid('selected') },
                            }
                        });
                        this.next();
                    });
                    return series;
                }
            }
            var owd_palette = new Palette(@json( $palette->toArray() ));
        </script>

        @stack('js_after')
    </body>
</html>
