<ul id="myTopnav" class="left-menu">
    <li><a href="/">vymôžete.sk</a></li>
    <li><a href="{{ Request::is('/') ? '#o_sluzbe' : url('/#o_sluzbe') }}">o službe</a></li>
    <li><a href="{{ Request::is('/') ? '#nasa_ponuka' : url('/#nasa_ponuka') }}">naša ponuka</a></li>
    <li><a href="{{ Request::is('/') ? '#postup' : url('/#postup') }}">ako to funguje</a></li>
    <li><a href="{{ Request::is('/') ? '#footer' : url('/#footer') }}">kontakt</a></li>
    <li><a href="#">vymôcť pohľadávku</a></li>
    <li class="icon">
        <span><i class="menu">menu</i></span>
    </li>
</ul>

<div class="right-menu">
    @auth()
        <a href="{{ route('front.home') }}" class="alogin">moje konto</a> |&nbsp;
        <a href="{{ url('/logout') }}" class="alogin">odhlásiť</a>&nbsp;
        @can('back-office')
        |
        <a href="{{ route('admin.home') }}" class="alogin">admin</a>
        @endcan
    @else
        <a href="{{ url('/login') }}" class="alogin">prihlásenie</a> /&nbsp;
        <a href="{{ url('/register') }}" class="alogin">registrácia</a>
    @endauth
</div>
