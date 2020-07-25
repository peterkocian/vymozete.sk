<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/admin_app.js') }}" defer></script>

    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @auth()
            <side-menu-component :config="{{ json_encode([
            'menuItems' => [
                [
                    "title" => "main",
                    "subItems" => [
                        [
                        "icon" => "dashboard",
                        "title" => "Dashboard",
                        "src" => "/admin"
                        ]
                    ]
                ],
                [
                    "title" => "settings",
                    "subItems" => [
                        [
                            "icon" => "supervised_user_circle",
                            "title" => "Users",
                            "src" => "/admin/users"
                        ]
                    ]
                ],
                [
                    "title" => "settings",
                    "subItems" => [
                        [
                            "icon" => "supervised_user_circle",
                            "title" => "Roles",
                            "src" => "/admin/roles"
                        ]
                    ]
                ],
                [
                    "title" => "settings",
                    "subItems" => [
                        [
                            "icon" => "supervised_user_circle",
                            "title" => "Permissions",
                            "src" => "/admin/permissions"
                        ]
                    ]
                ]
            ],
            'widthCollapsed' => 45,
            'widthUncollapsed' => 200,
            'isMenuCollapsed' => true,
            'logoSrc' => '/image/westech.png',
        ]) }}"></side-menu-component>
        @endauth

        <div class="main-wrapper">
            @include('admin.navigation.nav')

{{--            <main class="py-4">--}}
{{--                <div class="container-fluid">--}}
{{--                    @include('admin.flash-message')--}}

{{--                    @yield('content')--}}
{{--                </div>--}}
{{--            </main>--}}

            <main class="container-fluid main-container">
                @include('admin.flash-message')

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
