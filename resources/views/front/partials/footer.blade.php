<div id="footer" class="mainbox mainbox_blue">
    <img class="headline_logo" src="{{ asset('front/images/logo.svg') }}"/>
    <div class="row"></div>

    <div class="box_footer">
        <h2>Prevádzkovateľ</h2>
        <p>iVymáhanie s.r.o.<br/>
            Zámocká 30<br/>
            Bratislava<br/>
            811 01<br/><br/>
            IČO: 51025876<br/>
            DIČ: 2120732416
        </p>
    </div>

    <div class="box_footer">
        <h2>Kontakty</h2>
        <p><a href="tel:+421915721100">0915 721 100</a><br/><a href="mailto:info@vymozete.sk">info@vymozete.sk</a></p>
    </div>

    <div class="box_footer">
        <h2>Služba</h2>
        <p>
            @auth()
                <a href="/" class="alogin">moje konto</a><br>
                <a href="/" class="alogin">odhlásiť</a><br><br>
            @else
                <a href="{{ url('/register') }}" class="alogin">vytvoriť konto</a><br>
                <a href="{{ url('/login') }}" class="alogin">prihlásenie</a><br>
                <a href="{{ url('/password/reset') }}" class="alogin">strata hesla</a><br><br>
            @endauth

            <a href="{{ url('/vop') }}">Ochrana osobných údajov</a><br/>
            <a href="{{ url('/vop') }}">VOP</a>
        </p>
    </div>
    <div class="row"><p>vymozete.sk &copy; 2017 - {{ @now()->year }}</p></div>
    <a id="toTop" href="javascript:void(0);" style="/*display: none;">&#x21ea;</a>
</div>
