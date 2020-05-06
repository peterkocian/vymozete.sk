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
    <link rel="stylesheet" href="{{ asset('template_default/public.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700,900&amp;subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>

<noscript>
    <h2 style="text-align: center">Pre zobrazenie stránky je nutné mať povolený JavaScript.</h2>
    <style>.content { display:none; }</style>
</noscript>

<body>

<div class="menuline" id="domov">
    <div id="mySidenav" class="sidenav">
        <a href="#" type="button" class="closebtn">&times;</a>
        <a href="/">vymôžete.sk</a>
        <a href="{{ url('#o_sluzbe') }}">o službe</a>
        <a href="{{ url('#nasa_ponuka') }}">naša ponuka</a>
        <a href="{{ url('#postup') }}">ako to funguje</a>
        <a href="{{ url('#kontakt') }}">kontakt</a>
        <a href="/">vymôcť pohľadávku</a>
    </div>

    <div class="login">
        <a href="/" class="alogin">prihlásenie</a> /&nbsp;
        <a href="/" class="alogin">registrácia</a>
        <a href="/" class="alogin">moje konto</a> |&nbsp;
        <a href="/" class="alogin">odhlásiť</a>&nbsp;|
        <a href="/" class="alogin">admin</a>
    </div>

    <ul class="topnav" id="myTopnav">
        <li><a href="/">vymôžete.sk</a></li>
        <li><a href="{{ url('#o_sluzbe') }}">o službe</a></li>
        <li><a href="{{ url('#nasa_ponuka') }}">naša ponuka</a></li>
        <li><a href="{{ url('#postup') }}">ako to funguje</a></li>
        <li><a href="{{ url('#kontakt') }}">kontakt</a></li>
        <li><a href="/">vymôcť pohľadávku</a></li>
        <li class="icon">
            <span><i class="menu">menu</i></span>
        </li>
    </ul>
</div>

<div class="topspace">&nbsp;</div>

{{--main content--}}
<div class="homebox" id="domov">

    <img class="homebox_logo" src="{{ asset('template_default/images/logo_vymozete.svg') }}"/>
    <h1>Vy môžete viac.</h1>
    <p>Pohľadávky vymôžete online.</p>
    <a class="big_btn" href="/">vymôcť pohľadávku</a>
    <a class="small_btn" href="#o_sluzbe">zistiť viac</a>

</div>


<!--  SCREEN VÝHODY -->
<div class="mainbox_white" id="o_sluzbe">

    <div class="box_left">
        <h1>Prečo si vybrať vymozete.sk?</h1>
        <p>Máme za sebou viac ako 20 rokov skúsenosti s vymáhaním pohľadávok. Prinášame Vám online službu, ktorá Vám
            umožní využiť
            naše skúsenosti ešte jednoduchšie. Naše riešenie je vhodné pre kohokoľvek - nepodnikateľov (fyzické osoby),
            obch. spoločnosti aj živnostnikov.</p>
        <p><b>Riziko nesieme my.</b> Platíte až po úspešnom vymožení pohľadávky 20% z vymoženej sumy. V prípade
            neúspešného vymáhania nám neplatíte nič a odmenu za právne služby advokátskej kancelárie zaplatíme v celom
            rozsahu za Vás.</p>
    </div>

    <div class="box_right">

        <div class="box_grey">
            <img class="box_icon" src="{{ asset('template_default/images/order.svg') }}"/>
            <p><b>Aktuálny prehľad</b><br/>
                o každej Vašej pohľadávke</p>
        </div>

        <div class="box_grey">
            <img class="box_icon" src="{{ asset('template_default/images/notify.svg') }}"/>
            <p><b>Notifikácie</b><br/>
                o každom kroku cez SMS a email</p>
        </div>

        <div class="box_grey">
            <img class="box_icon" src="{{ asset('template_default/images/online.svg') }}"/>
            <p><b>E-služby</b><br/>
                Všetko vyriešite jednoducho a rýchlo online</p>
        </div>

        <div class="box_grey">
            <img class="box_icon" src="{{ asset('template_default/images/naklady.svg') }}"/>
            <p><b>Bez rizika</b><br/>
                Platíte nám až po úspešnom vymožení pohľadávky</p>
        </div>

    </div>

    <div class="row"><a class="big_btn" href="/nova">vymôcť pohľadávku</a></div>

</div>


<!--  Q -->
<div class="mainbox_blue" id="Q">
    <div class="row"><h1>5 dobrých dôvodov začať u nás:</h1></div>

    <div class="box_center">
        <h1>20+</h1>
        <p>Máme viac ako 20 rokov skúseností s vymáhaním pohľadávok.</p>
    </div>

    <div class="box_center">
        <h1>100%</h1>
        <p>Poskytujeme kompletný servis vymáhania pohľadávok.</p>
    </div>

    <div class="box_center">
        <h1>50 000+</h1>
        <p>Za sebou máme už viac ako 50 000 úspešne ukončených konaní.</p>
    </div>

    <div class="box_center">
        <h1>1.</h1>
        <p>Sme prvá spoločnosť v SR, ktorá poskytuje vymáhanie pohľadávok online.</p>
    </div>

    <div class="box_center">
        <h1>0,-</h1>
        <p>Ak neuspejeme, za naše služby neplatíte.</p>
    </div>

    <div class="row"><a class="big_btn" href="/nova">vymôcť pohľadávku</a></div>

</div>


<!--  SLUZBY -->
<div class="mainbox_white" id="nasa_ponuka">

    <div class="row"><h1>Je to skutočne jednoduché.</h1></div>
    <div class="row"><p>Pozrite sa, čo všetko môžeme vyriešiť online za Vás:</p></div>

    <div class="box_grey">
        <img class="box_icon" src="{{ asset('template_default/images/icon.svg') }}">
        <div class="box_mini">
            <p><b>Nezaplatená faktúra</b></p>
            <a class="small_btn" href="/nova?typp=fa">+ pridať</a>
        </div>
    </div>


    <div class="box_grey">
        <img class="box_icon" src="{{ asset('template_default/images/icon.svg') }}">
        <div class="box_mini">
            <p><b>Nezaplatené výživné</b></p>
            <a class="small_btn" href="/nova?typp=vy">+ pridať</a>
        </div>
    </div>

    <div class="box_grey">
        <img class="box_icon" src="{{ asset('template_default/images/icon.svg') }}">
        <div class="box_mini">
            <p><b>Nevrátená pôžička</b></p>
            <a class="small_btn" href="/nova?typp=po">+ pridať</a>
        </div>
    </div>

    <div class="box_grey">
        <img class="box_icon" src="{{ asset('template_default/images/icon.svg') }}">
        <div class="box_mini">
            <p><b>Nevyplatená zmenka</b></p>
            <a class="small_btn" href="/nova?typp=zm">+ pridať</a>
        </div>
    </div>

    <div class="box_grey">
        <img class="box_icon" src="{{ asset('template_default/images/icon.svg') }}">
        <div class="box_mini">
            <p><b>Nevyplatené nájomné</b></p>
            <a class="small_btn" href="/nova?typp=na">+ pridať</a>
        </div>
    </div>

    <div class="box_grey">
        <img class="box_icon" src="{{ asset('template_default/images/icon.svg') }}">
        <div class="box_mini">
            <p><b>Nevyplatená mzda</b></p>
            <a class="small_btn" href="/nova?typp=mz">+ pridať</a>
        </div>
    </div>

    <div class="box_grey">
        <img class="box_icon" src="{{ asset('template_default/images/icon.svg') }}">
        <div class="box_mini">
            <p><b>Nevyplatené poistné plnenie</b></p>
            <a class="small_btn" href="/nova?typp=pp">+ pridať</a>
        </div>
    </div>

</div>

<!-- individuálne riešenia -->
<div class="mainbox_blue">

    <div class="row"><h1>Máte toho oveľa viac?</h1></div>
    <div class="row"><p>Kontaktujte nás a my Vám vytvoríme riešenie na mieru.</p></div>

    <div class="box_transparent">
        <img class="box_icon" src="{{ asset('template_default/images/icon_white.svg') }}">
        <p><b>Hromadné podania</b></p>
    </div>

    <div class="box_transparent">
        <img class="box_icon" src="{{ asset('template_default/images/icon_white.svg') }}">
        <p><b>Komplexná správa pohľadávok</b></p>
    </div>

    <div class="box_transparent">
        <img class="box_icon" src="{{ asset('template_default/images/icon_white.svg') }}">
        <p><b>Exekúcie online</b></p>
    </div>

    <div class="row"></div>

    <div class="box_center">
        <p><b>Zavolajte nám:</b></p>
        <h3>0915 721 100</h3>
    </div>

    <div class="box_center">
        <p><b>Napíšte nám:</b></p>
        <h3>vovelkom@vymozete.sk</h3>
    </div>

</div>


<!--  jednotlive kroky -->
<div class="mainbox_white" id="postup">
    <div class="row"><h1>Ako to funguje?</h1></div>
    <div class="row">
        <p>Takto prebieha celý proces po zadaní novej pohľadávky.
        </p>
    </div>

    <div class="box_left">
        <h2>1. Kontrola pohľadávky</h2>
        <p>Bezplatne zabezpečíme kontrolu pohľadávky, ktorá spočíva v právnom posúdení a zistení bonity dlžníka. Ak bude
            Vaša pohľadávka vhodná na vymáhanie,
            môžete nás poveriť jej vymáhaním, prípadne nám ju po vzájomnej dohode odpredať.</p>
    </div>

    <div class="box_right">
        <div class="box_grey"><img class="box_icon" src="{{ asset('template_default/images/icon.svg') }}">
            <p><b>Zverenie do správy na vymáhanie</b></p></div>
        <div class="box_grey"><img class="box_icon" src="{{ asset('template_default/images/icon.svg') }}">
            <p><b>Predaj pohľadávky (vyplatenie)</b></p></div>
    </div>

    <div class="row"></div>

    <div class="box_left">
        <h2>2. Mimo súdne riešenie</h2>
        <p>Po zverení pohľadávky za účelom jej ďalšieho vymáhania na základe mandátnej zmluvy,
            poveríme vykonaním ďalších úkonov spolupracujúcu advokátsku kanceláriu, ktorá vyzve dlžníka predžalobnou
            výzvou na úhradu pohľadávky.
            Krok končí zaplatením, dohodnutím splátkového kalendára alebo pokračuje súdnym riešením.
        </p>
    </div>

    <div class="box_right">
        <div class="box_grey"><img class="box_icon" src="{{ asset('template_default/images/icon.svg') }}">
            <p><b>Služby advokátskej kancelárie</b></p></div>
        <div class="box_grey"><img class="box_icon" src="{{ asset('template_default/images/icon.svg') }}">
            <p><b>Predžalobná výzva</b></p></div>
    </div>

    <div class="row"></div>

    <div class="box_left">
        <h2>3. Súdne riešenie</h2>
        <p>V ďalšom kroku uplatníme Vašu pohľadávku na súde
            a podáme žalobu.</p>
    </div>

    <div class="box_right">
        <div class="box_grey"><img class="box_icon" src="{{ asset('template_default/images/icon.svg') }}">
            <p><b>Súdu zaplatíte súdny poplatok</b></p></div>
        <div class="box_grey"><img class="box_icon" src="{{ asset('template_default/images/icon.svg') }}">
            <p><b>Súd vydá rozhodnutie</b></p></div>
    </div>

    <div class="row"></div>

    <div class="box_left">
        <h2>4. Exekúcia pohľadávky</h2>
        <p>Po získaní právoplatného a vykonateľného rozhodnutia súdu podáme za Vás návrh na vykonanie exekúcie.
        </p>
    </div>

    <div class="box_right">
        <div class="box_grey"><img class="box_icon" src="{{ asset('template_default/images/icon.svg') }}">
            <p><b>Súdu zaplatíte súdny poplatok</b></p></div>
        <div class="box_grey"><img class="box_icon" src="{{ asset('template_default/images/icon.svg') }}">
            <p><b>Súdny exekútor začne výkon exekúcie.</b></p></div>
    </div>

    <div class="row"></div>

    <div class="box_left">
        <h2>5. Riziko nesieme my</h2>
        <p>Naše služby sú pre Vás počas celého procesu až po vymoženie pohľadávky bezplatné.
            Platíte až po úspešnom vymožení pohľadávky 20% z vymoženej sumy.
            V prípade neúspešného vymáhania nám neplatíte nič a odmenu advokátskej kancelárii zaplatíme v celom rozsahu
            za Vás.
        </p>
    </div>

    <div class="box_right">
        <div class="box_grey"><img class="box_icon" src="{{ asset('template_default/images/cena.svg') }}">
            <p><b>Naše služby neplatíte vopred</b></p></div>
        <div class="box_grey"><img class="box_icon" src="{{ asset('template_default/images/cena.svg') }}">
            <p><b>Ak neuspejeme, našu odmenu a náklady nám neplatíte</b></p></div>
    </div>


    <!--  button -->
    <div class="row"><a class="big_btn" href="/nova">vymôcť pohľadávku</a></div>

</div>

<!-- pohľadávky v číslach -->
<div class="mainbox_blue">
    <div class="row"><h1>Čo môžete čakať?</h1></div>
    <div class="row">
        <p>Takto vyzerá splácanie pohľadávok počas celého procesu.
        </p>
    </div>

    <div class="box_center">
        <h1>31%</h1>
        <p>dlžníkov uhradí pohľadávku po predžalobnej výzve.</p>
    </div>

    <div class="box_center">
        <h1>31%</h1>
        <p>dlžníkov uhradí pohľadávku po podaní žaloby.</p>
    </div>

    <div class="box_center">
        <h1>32%</h1>
        <p>dlžníkov uhradí pohľadávku po začatí exekúcie.</p>
    </div>

    <div class="box_center">
        <h1>6%</h1>
        <p>dlžníkov svoju pohľadávku nikdy nesplatí.</p>
    </div>


    <div class="row"><a class="big_btn" href="/nova">vymôcť pohľadávku</a></div>

</div>

{{--end main content--}}

<div class="mainbox_blue" id="kontakt">
    <img class="homebox_logo" src="{{ asset('template_default/images/logo.svg') }}"/>
    <div class="row"></div>

    <div class="box_footer">
        <h2>Prevádzkovateľ</h2>
        <p>iVymáhanie s.r.o.<br/>
            Zámocká 30<br/>
            Bratislava<br/>
            811 01<br/><br/>
            IČO: 51025876<br/>
            DIČ: 2120732416</p>
    </div>

    <div class="box_footer">
        <h2>Kontakty</h2>
        <p>0915 721 100<br/>
            info@vymozete.sk</p>
    </div>

    <div class="box_footer">
        <h2>Služba</h2>
        <p>
            <a href="/" class="alogin">moje konto</a><br>
            <a href="/" class="alogin">odhlásiť</a><br><br>
            <a href="/" class="alogin">vytvoriť konto</a><br>
            <a href="/" class="alogin">prihlásenie</a><br>
            <a href="/" class="alogin">strata hesla</a><br><br>

            <a href="/">Ochrana osobných údajov</a><br/>
            <a href="/">VOP</a>
        </p>
    </div>

    <div class="row"><p>vymozete.sk &copy 2017</p></div>
</div>

</body>
</html>
