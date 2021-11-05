<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        @include('partials.head')
    </head>
    <body>
        <div id="page-container" class="side-scroll page-header-fixed">

            @if( $user )
            @include('partials.right-sidebar')
            @endif

            @include('partials.navigation')

            <main id="main-container">
                @yield('message')
            </main>
        </div>

        <script src="{{ mix('/js/dashmix.app.js') }}"></script>

        @stack('js_after')
    </body>
</html>