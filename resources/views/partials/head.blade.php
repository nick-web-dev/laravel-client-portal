<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

<title>{{ env('APP_NAME') }}</title>

<meta name="description" content="{{ env('APP_NAME') }}">
<meta name="author" content="pixelcave">
<meta name="robots" content="noindex, nofollow">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Icons -->
<link rel="shortcut icon" type="image/svg+xml" href="{{ asset('img/favicon.svg') }}">
{{-- <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('img/favicon.svg') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon.svg') }}"> --}}

<!-- Fonts and Styles -->
@stack('css_before')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
<link rel="stylesheet" id="css-main" href="{{ mix('css/dashmix.css') }}">

<link rel="stylesheet" href="{{ asset('css/dx.common.css') }}">
<link rel="stylesheet" href="{{ asset('css/dx.generic.owd.css') }}">


<!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
{{-- <link rel="stylesheet" id="css-theme" href="{{ mix('css/themes/xwork.css') }}"> --}}
@stack('css_after')

<!-- Scripts -->
<script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
<!-- Bugherd -->
<script type="text/javascript" src="https://www.bugherd.com/sidebarv2.js?apikey=e7ydpucoogbcppklhh74kg" async="true"></script>