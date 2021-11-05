<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        @include('partials.head')
        <style>
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .code {
                border-right: 2px solid;
                font-size: 26px;
                padding: 0 15px 0 15px;
                text-align: center;
            }

            .message {
                font-size: 18px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div id="page-container" class="side-scroll page-header-fixed">

            @if( $user )
            @include('partials.right-sidebar')
            @endif

            @include('partials.navigation')

            <main id="main-container">
                <div class="flex-center position-ref h-100">
                    <div class="align-items-center bg-white d-flex nowrap p-6 shadow">
                        <div class="code">
                            @yield('code')
                        </div>
                        <div class="message" style="padding: 10px;">
                            @yield('message')
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <script src="{{ mix('/js/dashmix.app.js') }}"></script>

        @stack('js_after')
    </body>
</html>