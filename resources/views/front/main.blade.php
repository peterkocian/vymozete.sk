@extends('front.layout')

@section('content')
    <div class="headline">
        <img class="headline_logo" src="{{ asset('front/images/logo_vymozete.svg') }}"/>
        <h1>Vy môžete viac.</h1>
        <p>Pohľadávky vymôžete online.</p>
        <a class="big_btn" href="{{ route('front.claim') }}">vymôcť pohľadávku</a>
        <a class="small_btn" href="#o_sluzbe">zistiť viac</a>
    </div>

    <!--  section about us -->
    <div class="mainbox mainbox_white" id="o_sluzbe">
        <div class="box_left">
            <h1>Prečo si vybrať vymozete.sk?</h1>
            <p>Máme za sebou viac ako 20 rokov skúsenosti s vymáhaním pohľadávok. Prinášame Vám online službu, ktorá Vám
                umožní využiť
                naše skúsenosti ešte jednoduchšie. Naše riešenie je vhodné pre kohokoľvek - nepodnikateľov (fyzické osoby),
                obch. spoločnosti aj živnostnikov.
            </p>
            <p><b>Riziko nesieme my.</b> Platíte až po úspešnom vymožení pohľadávky 20% z vymoženej sumy. V prípade
                neúspešného vymáhania nám neplatíte nič a odmenu za právne služby advokátskej kancelárie zaplatíme v celom
                rozsahu za Vás.
            </p>
        </div>

        <div class="box_right">
            <div class="box_grey">
                <img class="box_icon" src="{{ asset('front/images/magnifier.svg') }}"/>
                <p><b>Aktuálny prehľad</b><br/>
                    o každej Vašej pohľadávke</p>
            </div>

            <div class="box_grey">
                <img class="box_icon" src="{{ asset('front/images/notify.svg') }}"/>
                <p><b>Notifikácie</b><br/>
                    o každom kroku cez SMS a email</p>
            </div>

            <div class="box_grey">
                <img class="box_icon" src="{{ asset('front/images/online.svg') }}"/>
                <p><b>E-služby</b><br/>
                    Všetko vyriešite jednoducho a rýchlo online</p>
            </div>

            <div class="box_grey">
                <img class="box_icon" src="{{ asset('front/images/lamp.svg') }}"/>
                <p><b>Bez rizika</b><br/>
                    Platíte nám až po úspešnom vymožení pohľadávky</p>
            </div>
        </div>
        <div class="row"><a class="big_btn" href="{{ route('front.claim') }}">vymôcť pohľadávku</a></div>
    </div>

    <!--  section Q&A -->
    <div class="mainbox mainbox_blue" id="Q">
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

        <div class="row"><a class="big_btn" href="{{ route('front.claim') }}">vymôcť pohľadávku</a></div>
    </div>

    <!--  section portfolio -->
    <div class="mainbox mainbox_white" id="nasa_ponuka">
        <div class="row"><h1>Je to skutočne jednoduché.</h1></div>
        <div class="row"><p>Pozrite sa, čo všetko môžeme vyriešiť online za Vás:</p></div>

        <div class="box_grey">
            <img class="box_icon" src="{{ asset('front/images/icon.svg') }}">
            <div class="box_mini">
                <div class="box_mini_title">Nezaplatená faktúra</div>
                <a class="small_btn" href="/claim/type?claim_type_id=1">+ pridať</a>
            </div>
        </div>

{{--        <div class="box_grey">--}}
{{--            <img class="box_icon" src="{{ asset('front/images/icon.svg') }}">--}}
{{--            <div class="box_mini">--}}
{{--                <div class="box_mini_title">Nezaplatené výživné</div>--}}
{{--                @auth()--}}
{{--                    <a class="small_btn" href="/claim/type?claim_type_id=2">+ pridať</a>--}}
{{--                @endauth--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="box_grey">
            <img class="box_icon" src="{{ asset('front/images/icon.svg') }}">
            <div class="box_mini">
                <div class="box_mini_title">Nevrátená pôžička</div>
                <a class="small_btn" href="/claim/type?claim_type_id=3">+ pridať</a>
            </div>
        </div>

        <div class="box_grey">
            <img class="box_icon" src="{{ asset('front/images/icon.svg') }}">
            <div class="box_mini">
                <div class="box_mini_title">Nevyplatená zmenka</div>
                <a class="small_btn" href="/claim/type?claim_type_id=4">+ pridať</a>
            </div>
        </div>

        <div class="box_grey">
            <img class="box_icon" src="{{ asset('front/images/icon.svg') }}">
            <div class="box_mini">
                <div class="box_mini_title">Nevyplatené nájomné</div>
                <a class="small_btn" href="/claim/type?claim_type_id=5">+ pridať</a>
            </div>
        </div>

        <div class="box_grey">
            <img class="box_icon" src="{{ asset('front/images/icon.svg') }}">
            <div class="box_mini">
                <div class="box_mini_title">Nevyplatená mzda</div>
                <a class="small_btn" href="/claim/type?claim_type_id=6">+ pridať</a>
            </div>
        </div>

        <div class="box_grey">
            <img class="box_icon" src="{{ asset('front/images/icon.svg') }}">
            <div class="box_mini">
                <div class="box_mini_title">Nevyplatené poistné plnenie</div>
                <a class="small_btn" href="/claim/type?claim_type_id=7">+ pridať</a>
            </div>
        </div>

        <div class="box_grey">
            <img class="box_icon" src="{{ asset('front/images/icon.svg') }}">
            <div class="box_mini">
                <div class="box_mini_title">Náhrada škody</div>
                <a class="small_btn" href="/claim/type?claim_type_id=8">+ pridať</a>
            </div>
        </div>
    </div>

    <!-- section contact us -->
    <div class="mainbox mainbox_blue">
        <div class="row"><h1>Máte toho oveľa viac?</h1></div>
        <div class="row"><p>Kontaktujte nás a my Vám vytvoríme riešenie na mieru.</p></div>

        <div class="box_transparent">
            <img class="box_icon" src="{{ asset('front/images/icon_white.svg') }}">
            <p><b>Hromadné podania</b></p>
        </div>

        <div class="box_transparent">
            <img class="box_icon" src="{{ asset('front/images/icon_white.svg') }}">
            <p><b>Komplexná správa pohľadávok</b></p>
        </div>

        <div class="box_transparent">
            <img class="box_icon" src="{{ asset('front/images/icon_white.svg') }}">
            <p><b>Exekúcie online</b></p>
        </div>

        <div class="row"></div>

        <div class="box_center">
            <p><b>Zavolajte nám:</b></p>
            <h3><a href="tel:+421915721100">0915 721 100</a></h3>
        </div>

        <div class="box_center">
            <p><b>Napíšte nám:</b></p>
            <h3><a href="mailto:vovelkom@vymozete.sk">vovelkom@vymozete.sk</a></h3>
        </div>
    </div>

    <!--  section how it works -->
    <div class="mainbox mainbox_white" id="postup">
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
            <div class="box_grey"><img class="box_icon" src="{{ asset('front/images/icon.svg') }}">
                <p><b>Zverenie do správy na vymáhanie</b></p></div>
            <div class="box_grey"><img class="box_icon" src="{{ asset('front/images/icon.svg') }}">
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
            <div class="box_grey"><img class="box_icon" src="{{ asset('front/images/icon.svg') }}">
                <p><b>Služby advokátskej kancelárie</b></p></div>
            <div class="box_grey"><img class="box_icon" src="{{ asset('front/images/icon.svg') }}">
                <p><b>Predžalobná výzva</b></p></div>
        </div>

        <div class="row"></div>

        <div class="box_left">
            <h2>3. Súdne riešenie</h2>
            <p>V ďalšom kroku uplatníme Vašu pohľadávku na súde
                a podáme žalobu.</p>
        </div>

        <div class="box_right">
            <div class="box_grey"><img class="box_icon" src="{{ asset('front/images/icon.svg') }}">
                <p><b>Súdu zaplatíte súdny poplatok</b></p></div>
            <div class="box_grey"><img class="box_icon" src="{{ asset('front/images/icon.svg') }}">
                <p><b>Súd vydá rozhodnutie</b></p></div>
        </div>

        <div class="row"></div>

        <div class="box_left">
            <h2>4. Exekúcia pohľadávky</h2>
            <p>Po získaní právoplatného a vykonateľného rozhodnutia súdu podáme za Vás návrh na vykonanie exekúcie.
            </p>
        </div>

        <div class="box_right">
            <div class="box_grey"><img class="box_icon" src="{{ asset('front/images/icon.svg') }}">
                <p><b>Súdu zaplatíte súdny poplatok</b></p></div>
            <div class="box_grey"><img class="box_icon" src="{{ asset('front/images/icon.svg') }}">
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
            <div class="box_grey"><img class="box_icon" src="{{ asset('front/images/cena.svg') }}">
                <p><b>Naše služby neplatíte vopred</b></p></div>
            <div class="box_grey"><img class="box_icon" src="{{ asset('front/images/cena.svg') }}">
                <p><b>Ak neuspejeme, našu odmenu a náklady nám neplatíte</b></p></div>
        </div>
        <div class="row"><a class="big_btn" href="{{ route('front.claim') }}">vymôcť pohľadávku</a></div>
    </div>

    <!-- section stats -->
    <div class="mainbox mainbox_blue">
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
        <div class="row"><a class="big_btn" href="{{ route('front.claim') }}">vymôcť pohľadávku</a></div>
    </div>
@endsection
