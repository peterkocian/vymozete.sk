<ul id="myTopnav" class="left-menu">
    <li><a href="/">vymôžete.sk</a></li>
    <li><a href="{{ url('#o_sluzbe') }}">o službe</a></li>
    <li><a href="{{ url('#nasa_ponuka') }}">naša ponuka</a></li>
    <li><a href="{{ url('#postup') }}">ako to funguje</a></li>
    <li><a href="{{ url('#footer') }}">kontakt</a></li>
    <li><a href="/">vymôcť pohľadávku</a></li>
    <li class="icon">
        <span><i class="menu">menu</i></span>
    </li>
</ul>

<div class="right-menu">
    <a href="/" class="alogin">prihlásenie</a> /&nbsp;
    <a href="/" class="alogin">registrácia</a>
    @auth()
        <a href="/" class="alogin">moje konto</a> |&nbsp;
        <a href="/" class="alogin">odhlásiť</a>&nbsp;|
        <a href="/" class="alogin">admin</a>
    @endauth
</div>
