<ul id="myTopnav" class="left-menu">
    <li><a href="/">vymôžete.sk</a></li>
    <li><a href="{{ Request::is('/') ? '#o_sluzbe' : url('/#o_sluzbe') }}">o službe</a></li>
    <li><a href="{{ Request::is('/') ? '#nasa_ponuka' : url('/#nasa_ponuka') }}">naša ponuka</a></li>
    <li><a href="{{ Request::is('/') ? '#postup' : url('/#postup') }}">ako to funguje</a></li>
    <li><a href="{{ Request::is('/') ? '#footer' : url('/#footer') }}">kontakt</a></li>
    <li><a href="/">vymôcť pohľadávku</a></li>
    <li class="icon">
        <span><i class="menu">menu</i></span>
    </li>
</ul>

<div class="right-menu">
    <a href="{{ url('/login') }}" class="alogin">prihlásenie</a> /&nbsp;
    <a href="{{ url('/register') }}" class="alogin">registrácia</a>
    @auth()
        <a href="/" class="alogin">moje konto</a> |&nbsp;
        <a href="/" class="alogin">odhlásiť</a>&nbsp;|
        <a href="/admin" class="alogin">admin</a>
    @endauth
</div>
