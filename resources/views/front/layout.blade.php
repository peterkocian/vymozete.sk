<!DOCTYPE html>
<html lang="sk">
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-7L818077L0"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-7L818077L0');
        </script>

        <title>vymozete.sk - jednoduché online riešenie pohľadávok</title>
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta http-equiv="Content-Script-Type" content="application/javascript" />

        <meta name="description" content="vymozete.sk - jednoduché online riešenie pohľadávok" />
        <meta name="keywords" content="vymozete, vymozete.sk, pohladavky, pohľadávky, pohladavky online, riesenie pohladavok, riešenie pohľadávok, online riesenie pohladavok, online riešenie pohľadávok, riešenie pohľadávky, online riešenie pohľadávky" />
        <meta name="author" content="Vymozete.sk" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, user-scalable=no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('front/css/template.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700,900&amp;subset=latin-ext" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/front_app.js') }}" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    {{--    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>--}}
    </head>
    <body>
        <noscript>
            <h2 style="text-align: center; color: black;">Pre zobrazenie stránky je nutné mať povolený JavaScript.</h2>
            <style>.content { display:none; }</style>
        </noscript>
        <div id="app" class="content">
            <div class="main-menu">
                @include('front.partials.navigation.mobile_nav')
                @include('front.partials.navigation.main')
            </div>

            @yield('content')
            @include('front.partials.footer')
        </div>
    </body>
    <script src="{{ asset('front/js/custom.js') }}"></script>
</html>
