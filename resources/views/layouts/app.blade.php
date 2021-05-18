<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-G1D0YSC2FS"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-G1D0YSC2FS',{
            'page_title' : document.title,
            'page_location' : location.href,
            'page_path': location.pathname,
            'send_page_view' : true
        });
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" defer>
    <link href="{{ asset('css/app_additional.css') }}" rel="stylesheet" defer>
</head>

<body>

    @include('layouts.preloader')

    @include('layouts.header')

    <div id="app">
        <main class="py-4">
            @include('layouts.flash_message')
            @yield('content')
        </main>
    </div>

    @include('layouts.footer')

</body>

<script src="{{ asset('js/layout.js') }}" defer></script>

</html>