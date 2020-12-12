<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Predžalobná upomienka</title>
    <style>
        html {
            size: 7in 9.25in;
            margin: 27mm 16mm;
        }
        .page-break {
            page-break-after: always;
        }
        /*html,body {  padding:0px; margin:0; overflow:hidden}*/
        body {
            /*padding:0px; margin:0;*/
            /*font-family: "firefly, DejaVu Sans, sans-serif;";*/
            text-align: justify;
            font-size: 10px;
            line-height: 1;
        }
        h1 {
            font-size: 14px;
        }
        h2 {
            font-size: 10px;
            font-weight: bolder;
        }
        ul {
            list-style: inside;
        }
        .debtor-info {
            max-width: 180px;
            margin-left: auto;
            text-align: left;
        }
        .creditor-regards{
            float:left;
        }
        .barkoci-law {
            margin-left: auto;
            width: 180px;
            text-align: left;
        }
        header {
            position: fixed;
            top: -60px;
            left: 0;
            right: 0;
            width: 100%;
        }
        header .barkoci-logo {
            width: 550px;
        }
        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            border-top: 2px solid black;
        }
        footer img {
            width: 550px;
        }
    </style>
</head>
<body>
    <header>
        <img src="{{asset('images/header_barkoci.png')}}" alt="xxx" class="barkoci-logo">
    </header>
    <main>
        <div class="debtor-info">
            {{$claim->debtor->entity->fullName}} <br>
            {{$claim->debtor->entity->fullAddress}} <br>
            Identifikátor: {{ $claim->id }} <br>
            Bratislava, dátum: {{date('d.m.Y')}}
        </div>
        <h1>Predžalobná upomienka</h1>
        <p>V právnej veci veriteľa:
{{--            if veritel is FO--}}
            {{$claim->creditor->entity->fullName}},
            dátum narodenia: {{$claim->creditor->entity->birthday}},
            rodné číslo: {{$claim->creditor->entity->id_number}},
            trvalý pobyt: {{$claim->creditor->entity->fullAddress}},
            št. občianstvo: {{$claim->creditor->entity->citizenship}},
            (ďalej len "veriteľ"), proti dlžníkovi: {{$claim->debtor->entity->fullName}} (ďalej len "dlžník"), o zaplatenie pohľadávky vo výške {{$claim->amount}} {{$claim->currency->code}}  s príslušenstvom, z titulu {{$claim->typeName}}, Vám týmto oznamujeme, že sme prevzali právne zastúpenie veriteľa a uvádzame nasledovné:</p>
        <p>Veriteľ voči Vám k dnešnému eviduje peňažnú pohľadávku v nasledovnej výške:</p>
        <ul>
            <li>Istina vo výške {{$claim->amount}} {{ $claim->currency->code }},</li>
            <li>Úroky z omeškania k dnešnému dňu {{date('d.m.Y')}} vo výške {{'todo'}} Eur.</li>
        </ul>
        <p>Veriteľovi v spojitosti s uplatňovaním si svojho práva voči Vám vznikli náklady na právne zastúpenie v podobe trov právneho zastúpenia, ktoré predstavujú náklady na účelné uplatňovanie si veriteľovho práva. Trovy právneho zastúpenia predstavujú k dnešnému dňu sumu {{'todo'}} Eur spolu s daňou z pridanej hodnoty (vypočítané podľa ustanovenia § 9 a nasl. vyhlášky MS SR č. 655/2004 Z.z. o odmenách a náhradách advokátov za poskytovanie právnych služieb).</p>
        <h2>CELKOVÁ VÝŠKA POHĽADÁVKY: {total}, VS: {vs}, č. účtu (IBAN): SK07 5600 0000 0067 5613 6001.</h2>
        <p>Vzhľadom na vyššie uvedené skutočnosti Vás týmto vyzývame k úhrade uvedenej sumy na účet (IBAN): SK07 5600 0000 0067 5613 6001, pod VS: {vs} a to v lehote do 7 dní. V prípade úhrady pod iným variabilným symbolom alebo na iné číslo účtu sa vystavujete vymáhaniu pohľadávky súdnou cestou, pretože nedôjde k správnej identifikácii Vašej platby.</p>
        <p>Po márnom uplynutí poskytnutej lehoty máme poverenie od veriteľa vymáhať vyššie uvedenú sumu súdnou cestou vrátane úroku z omeškania a trov právneho zastúpenia, čím Vám vzniknú zbytočné a relatívne vysoké trovy súdneho a následne exekučného konania.</p>
        <p>V prípade akýchkoľvek otázok nás prosím kontaktujte na emailovej adrese office@barkoci.sk alebo pohladavky@vymozete.sk.</p>
        <div class="footer-container">
            <div class="creditor-regards">
                S pozdravom, <br>
                <b>{{ $claim->creditor->entity->fullName}}</b>
            </div>
            <div class="barkoci-law">
                Právne zastúpenie:<br>
                <b>BARKOCI law firm, s.r.o.</b><br>
                konajúca prostr.:<br>
                JUDr. Stanislav Barkoci, PhD. advokát a konateľ
            </div>
        </div>
        <p>Príloha: plnomocenstvo</p>
    </main>
    <footer>
        <img src="{{asset('images/footer_barkoci.png')}}" alt="yyy">
    </footer>
{{--    <div class="page-break"></div>--}}
{{--    <h1>Page 2</h1>--}}
{{--+ľščťžýáíé=úäô--}}
</body>
</html>
