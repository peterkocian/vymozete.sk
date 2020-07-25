<nav class="navbar navbar-expand navbar-light navbar-top navbar-top-container">
    <div class="container-fluid">
{{--        <a class="navbar-brand" href="{{ url('/admin') }}">--}}
{{--            {{ config('app.name', 'Laravel') }}--}}
{{--        </a>--}}
{{--        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @auth
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{ route('admin.users.index') }}">{{ __('menu-item.Users') }}</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{ route('admin.roles.index') }}">{{ __('menu-item.Roles') }}</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{ route('admin.permissions.index') }}">{{ __('menu-item.Permissions') }}</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{ route('admin.claims.index') }}">{{ __('menu-item.Claims') }}</a>--}}
{{--                    </li>--}}
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.loginForm') }}">{{ __('Login') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span class="material-icons">account_circle</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <div class="static-dropdown-item">{{ \Illuminate\Support\Facades\Auth::user()->full_name }}</div>
                            <a class="dropdown-item" href="{{ route('admin.users.editProfile', Auth::id()) }}">
                                {{ __('menu-item.Profile') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.logout') }}">{{ __('Logout') }}</a>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
