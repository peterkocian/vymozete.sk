<div id="mySidenav" class="mobile-menu">
    <a type="button" class="closebtn">&times;</a>
    <a href="/">vymôžete.sk</a>
    <a href="{{ Request::is('/') ? '#o_sluzbe' : url('/#o_sluzbe') }}">o službe</a>
    <a href="{{ Request::is('/') ? '#nasa_ponuka' : url('/#nasa_ponuka') }}">naša ponuka</a>
    <a href="{{ Request::is('/') ? '#postup' : url('/#postup') }}">ako to funguje</a>
    <a href="{{ Request::is('/') ? '#footer' : url('/#footer') }}">kontakt</a>
    <a href="/">vymôcť pohľadávku</a>
</div>
