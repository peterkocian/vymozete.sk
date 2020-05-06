<!DOCTYPE html>
<html lang="sk">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta http-equiv="Content-Script-Type" content="application/javascript" />

        <meta name="description" content="vymozete.sk - jednoduché online riešenie pohľadávok" />
        <meta name="keywords" content="vymozete, vymozete.sk, pohladavky, pohľadávky, pohladavky online, riesenie pohladavok, riešenie pohľadávok, online riesenie pohladavok, online riešenie pohľadávok, riešenie pohľadávky, online riešenie pohľadávky" />
        <meta name="author" content=" " />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1,user-scalable=no">

        <title>vymozete.sk - jednoduché online riešenie pohľadávok</title>

        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('template_default/css/public.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700,900&amp;subset=latin-ext" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    {{--    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>--}}
    </head>
    <body>
        <noscript>
            <h2 style="text-align: center; color: black;">Pre zobrazenie stránky je nutné mať povolený JavaScript.</h2>
            <style>.content { display:none; }</style>
        </noscript>
        <div class="content">
            <div class="main-menu">
                @include('template_default.navigation.mobile_nav')
                @include('template_default.navigation.main')
            </div>

        {{--    <div class="topspace">&nbsp;</div>--}}


            @include('template_default.main')
{{--            @yield('content')--}}
            @include('template_default.footer')
        </div>
    </body>
    @push ('scripts')
        <script src="{{ asset('template_default/js/custom.js') }}"></script>
    @endpush
</html>
