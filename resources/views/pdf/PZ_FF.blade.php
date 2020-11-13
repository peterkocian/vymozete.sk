<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Príkazná zmluva</title>
    <style>
        html {
            size: 7in 9.25in;
            margin: 25mm  16mm 27mm 16mm;
        }
        header {
            position: fixed;
            top: -100px;
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
            left: 0;
            right: 0;
            border-top: 1px solid black;
        }
        footer img {
            width: 550px;
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
            font-size: 28px;
            text-align: center;
        }
        h2 {
            font-size: 16px;
        }
        h3 {
            font-size: 12px;
        }
        .height-40{
            height: 40px;
        }
        .align-center {
            text-align: center;
        }
        .align-left {
            text-align: left;
        }
        .align-justify {
            text-align: justify;
        }
        .pl-0 {
            padding-left: 0;
        }
        .pl-20{
            padding-left: 20px;
        }
        .pr-5 {
            padding-right: 5px;
        }
        table td.width-half {
            width: 260px;
        }
        table.bordered{
            border: 1px solid black;
            border-collapse: collapse;
        }
        table.bordered td {
            border: 1px solid black;
        }
        table td.va-top {
            vertical-align: top;
        }
        tr.border-bottom td {
            border-bottom: 1px solid black;
        }
        .pb-10{
            padding-bottom: 10px;
        }
        ol.nested-counter {
            counter-reset: section;
            list-style-type: none;
        }
        ol.nested-counter li {
            counter-increment: section;
            display: block;
            padding: 0 0 0 20px;
            page-break-inside: avoid;
            position: relative;
        }
        ol.nested-counter li:before {
            content: counters(section, ".") " ";
            display: block;
            position: absolute;
            left: 0;
        }
        ol.alphabet > li {
            list-style: lower-alpha;
            display: list-item;
            padding-left: 0;
        }
        ol.nested-counter .alphabet > li:before {
            /*list-style: lower-alpha;*/
            content:"";
        }
        .none {
            list-style: none;
        }
        ol.nested-counter li.none{
            padding-left: 0;
        }
        ol.nested-counter li.none:before {
            content:"";
        }
    </style>
</head>
<body>
<header>
    <img src="{{asset('images/header_vymozete.png')}}" alt="xxx" class="barkoci-logo">
</header>
<main>
    <h1>PRÍKAZNÁ ZMLUVA</h1>
    <p class="align-center">(uzatvorená podľa § 724 a nasl. zákona č. 40/1964 Zb. Občianskeho zákonník v znení neskorších predpisov a v zmysle ustanovení zákona č. 586/2003 Z.z. o advokácii v znení neskorších predpisov)</p>
    <h2 class="align-left">ZMLUVNÉ STRANY:</h2>

    <table class="bordered">
        <tr>
            <td class="width-half va-top">
                <ol class="pl-20 pr-5">
                    <li>
                        Meno a priezvisko: {{$claim->creditor->entity->fullName}}<br>
                        Dátum narodenia: {{$claim->creditor->entity->birthday}}<br>
                        Rodné číslo: {{$claim->creditor->entity->id_number}}<br>
                        Trvalý pobyt: {{$claim->creditor->entity->fullAddress}}<br>
                        Št. občianstvo: {{$claim->creditor->entity->citizenship}}<br>
                        (ďalej len „<b>príkazca</b>“)
                    </li>
                </ol>
            </td>
            <td class="width-half va-top">
                <ol class="pl-20 pr-5">
                    <li class="none"></li>
                    <li>
                        <b>iVymáhanie s.r.o.</b><br>
                        so sídlom Zámocká 30, 811 01 Bratislava, zapísaná v Obchodnom registri vedenom Okresným súdom Bratislava I, oddiel: Sro, vložka č. 123274/B<br>
                        IČO: 51 025 876<br>
                        Konajúca prostr.: JUDr. Michal Gálik, PhD. – konateľ; Ing. Andrea Jakubcová – konateľ<br>
                        (ďalej len „<b>príkazník</b>“)<br>
                    </li>
                    <p>a</p>
                    <li>
                        <b>BARKOCI law firm, s.r.o.</b><br>
                        so sídlom Námestie slobody 28, 811 06 Bratislava – Staré Mesto, zapísaná v Obchodnom  registri: Okresného súdu Bratislava I, Oddiel: Sro, Vložka číslo: 88740/B<br>
                        IČO: 47 247 916<br>
                        DIČ: SK2024164934<br>
                        IČ DPH: SK2024164934<br>
                        Konajúca prostr.: JUDr. Stanislav Barkoci, PhD. – konateľ a advokát<br>
                        (ďalej len „<b>advokát</b>“)<br>
                    </li>
                </ol>
            </td>
        </tr>
    </table>

    <ol class="pl-0 nested-counter">
        <li class="none">
            <h2 class="align-center">1. PREDMET ZMLUVY</h2>
            <ol class="pl-0 nested-counter">
                <li>Príkazník sa zaväzuje v mene  príkazcu a na jeho účet robiť úkony smerujúce k vymoženiu pohľadávky, ktorá je špecifikovaná v prílohe č. 1 tejto zmluvy, vrátane jej príslušenstva a prípadných zmluvných sankcií (ďalej len "Pohľadávka").</li>
                <li>Advokát sa zaväzuje poskytnúť príkazcovi právne služby spočívajúce v zastupovaní príkazcu pri uplatňovaní jeho nároku, predmetom ktorého je zaplatenie Pohľadávky a jej príslušenstva, a to až do jej úplného zaplatenia, vrátane uplatnenia nároku v súdnom aj exekučnom konaní, pričom právne služby sa advokát zaväzuje poskytnúť podľa zákona č. 586/2003 Z. z. o advokácii v znení neskorších predpisov, bližšie špecifikované v bode 1.4 tohto článku.</li>
                <li>Príkazca výslovne požaduje poskytovanie služieb podľa tejto Zmluvy od okamihu uzavretia tejto zmluvy.</li>
            </ol>
        </li>

        <footer>
            <img src="{{asset('images/footer_barkoci.png')}}" alt="yyy">
        </footer>

        <li class="none">
            <h2 class="align-center">2. TRVANIE ZMLUVY</h2>
            <ol class="pl-0 nested-counter">
                <li>Táto zmluva zaniká splnením záväzku dlžníka, ak je Pohľadávka vymožená, a ak je príkazníkovi a/alebo advokátovi uhradená jeho odmena podľa tejto zmluvy, ak sa nedohodnú zmluvné strany inak.</li>
                <li>Príkazca je oprávnený túto zmluvu vypovedať aj bez uvedenia dôvodu, a to písomnou výpoveďou s jednomesačnou výpovednou lehotou, ktorá začína plynúť prvým dňom mesiaca nasledujúceho po mesiaci, v ktorom bola výpoveď doručená druhej zmluvnej strane.</li>
                <li>Príkazník je oprávnený túto zmluvu vypovedať z dôvodov porušenia povinností príkazcu uvedených v článku  3. tejto zmluvy, ak nie je porušenie na výzvu príkazníka príkazcom napravené, a to písomnou výpoveďou účinnou dňom doručenia výpovede príkazcovi.</li>
                <li>Advokát je oprávnený túto zmluvy vypovedať aj bez uvedenia dôvodu, a to písomnou výpoveďou s jednomesačnou výpovednou lehotou, ktorá začína plynúť prvým dňom mesiaca nasledujúceho po mesiaci, v ktorom bola výpoveď doručená druhej zmluvnej strane.</li>
                <li>Advokát je oprávnený odstúpiť od tejto zmluvy v prípadoch ustanovených zákonom č. 586/2003 Z. z. o advokácii v znení neskorších predpisov.</li>
            </ol>
        </li>

        <li class="none">
            <h2 class="align-center">3. PRÁVA A POVINNOSTI PRÍKAZCU</h2>
            <ol class="pl-0 nested-counter">
                <li>Príkazca je povinný poskytnúť príkazníkovi a advokátovi o Pohľadávke a dlžníkovi všetky jemu známe a existujúce informácie, údaje a doklady, ktoré majú súvislosť s plnením predmetu tejto zmluvy, a zadávať príkazníkovi a/alebo advokátovi pokyny zrozumiteľne a jednoznačne. Príkazca je ďalej povinný poskytnúť príkazníkovi a/alebo advokátovi súčinnosť potrebnú k naplneniu účelu tejto zmluvy, najmä aktualizovať svoje kontaktné údaje a udržiavať komunikáciu v lehotách obvyklých pre zvolený spôsob komunikácie (e-mail, telefón), t.j. {{$claim->creditor->entity->email}}, {{$claim->creditor->entity->phone}}. Príkazca je povinný informovať bezodkladne, najneskôr do 5 (piatich) pracovných dní,  príkazníka a/alebo advokáta o akýchkoľvek platbách jemu poskytnutých na uhradenie vymáhanej Pohľadávky, vrátane akýchkoľvek (akéhokoľvek) zápočtov (započítania) oproti Pohľadávke.</li>
                <li>Príkazca zodpovedá za skutočnosť, že všetky príkazníkovi a/alebo advokátovi poskytnuté informácie sú pravdivé a úplné, že Pohľadávka existuje, a nesie plnú právnu zodpovednosť za škodu spôsobenú týmto nepravdivým uistením príkazníka a/alebo advokáta.</li>
                <li>Príkazca je povinný súčasne s podpisom tejto zmluvy vystaviť advokátovi písomnú plnú moc oprávňujúcu ho ku konaniam, ktoré sú predmetom tejto zmluvy. Advokát príkazcovi nezaručuje konečný výsledok v právnej veci, v ktorej mu poskytuje právne služby.</li>
                <li>Zmluvné strany sa dohodli, že súdne poplatky a preddavky na vykonanie dôkazov (na znalecký posudok a pod.), prípadne náklady súdne nariadenej mediácie, vzniknuté v súvislosti s vymáhaním Pohľadávky, hradí príkazca. Príkazca berie na vedomie, že v prípade neuhradenia preddavkov na vykonanie dôkazov môže dôjsť k nevykonaniu navrhnutého dôkazu ako aj k prípadnému zamietnutiu žaloby, a k uloženiu povinnosti príkazcovi uhradiť žalovanému náhradu trov konania.</li>
                <li>Príkazca výslovne súhlasí, aby náhrada trov konania (s výnimkou príkazcom uhradeného súdneho poplatku, prípadne preddavkov na vykonanie dôkazov alebo nákladov mediácie) priznaná v prípadnom súdnom konaní, prípadne exekučnom konaní, prebiehajúcom ohľadom Pohľadávky, patrila v plnej výške advokátovi ako jeho odmena.</li>
            </ol>
        </li>

        <li class="none">
            <h2 class="align-center">4. ODMENA PRÍKAZNÍKA</h2>
            <ol class="pl-0 nested-counter">
                <li>Príkazníkovi vzniká nárok na odmenu až momentom vymoženia Pohľadávky alebo jej časti. Odmena príkazníka za obstaranie záležitosti podľa článku 1. tejto zmluvy je 20% plus daň z pridanej hodnoty, účtovaná v zmysle platných predpisov, z vymoženej Pohľadávky alebo jej časti. Príkazca berie na vedomie, že od okamihu uzavretia tejto zmluvy sa akékoľvek platby dlžníka považujú za vymožené na základe tejto zmluvy.</li>
                <li>Príkazca výslovne splnomocňuje príkazníka, aby inkasoval platby od dlžníka na vymáhanú Pohľadávku. Trovy právneho zastúpenia inkasuje advokát. Po vymožení Pohľadávky alebo jej časti, je príkazník povinný ju príkazcovi bez zbytočného odkladu vyúčtovať po odčítaní odmeny príkazníka podľa bodu 4.1 tejto zmluvy.</li>
                <li>Ak je Pohľadávka, alebo jej časť uhradená dlžníkom priamo príkazcovi, príkazca je povinný o tom bezodkladne informovať príkazníka a zároveň je príkazca povinný uhradiť príkazníkovi odmenu podľa bodu 4.1 tejto zmluvy do piatich (5) pracovných dní odo dňa obdržania úhrady.</li>
                <li>Zmluvné strany sa dohodli, že príkazca je povinný v prípade zmarenia účelu tejto zmluvy a/alebo porušenia povinností podľa tejto zmluvy zo strany príkazcu uhradiť advokátovi tarifnú odmenu za vykonané úkony právnej služby, náhradu hotových výdavkov náhradu za stratu času a náhradu výdavkov na miestne telekomunikačné výdavky a miestne prepravné sumu vo výške jednej stotiny výpočtového základu za každý úkon právnej služby (režijný paušál)v zmysle  vyhlášky Ministerstva spravodlivosti Slovenskej republiky č. 655/2004 Z. z., o odmenách a náhradách advokátov za poskytovanie právnych služieb. Príkazca je povinný v prípade zmarenia účelu tejto zmluvy uhradiť príkazníkovi zmluvnú pokutu vo výške 10% z Pohľadávky. Zmarením účelu tejto zmluvy sa pre účely tejto zmluvy rozumie:</li>
                <ol class="alphabet">
                    <li>neuhradenie súdneho poplatku, preddavku na vykonanie dôkazov, znalecký posudok či nákladov mediácie príkazcom, alebo</li>
                    <li>neúčasť príkazcu na súdom nariadenej mediácii po písomnej výzve advokáta, alebo</li>
                    <li>ak vyjde najavo v súdnom alebo inom konaní, že Pohľadávka neexistuje, alebo</li>
                    <li>porušenie povinnosti informovať o akýchkoľvek platbách príkazcovi poskytnutých na vymáhanú Pohľadávku, vrátane akýchkoľvek zápočtov na ňu podľa bodu 3.1 tejto zmluvy, alebo</li>
                    <li>porušenie povinností príkazcu v zmysle tejto zmluvy, najmä v zmysle článku 3 tejto zmluvy</li>
                </ol>
                4.5. Príkazca je povinný v prípade rozhodnutia príkazcu nepokračovať vo vymáhaní Pohľadávky na základe tejto zmluvy, vrátane rozhodnutia nepokračovať vo vymáhaní Pohľadávky v exekučnom konaní po vydaní právoplatného rozhodnutia uhradiť  príkazníkovi paušálnu náhradu výdavkov vo výške  vo výške 20% z Pohľadávky.
            </ol>
        </li>

        <li class="none">
            <h2 class="align-center">5. ODMENA ADVOKÁTA</h2>
            <ol class="pl-0 nested-counter">
                <li><b>Príkazca a príkazník sa dohodli, že odmenu advokáta bude znášať príkazca až dňom vymoženia Pohľadávky alebo jej časti, do tohto momentu znáša odmenu advokáta v celom rozsahu príkazník.</b> Po vymožení Pohľadávky alebo jej časti sa Príkazca zaväzuje zaplatiť advokátovi odmenu (v prípade vymoženia časti Pohľadávky jej pomernú časť), ktorá bola dohodnutá ako tarifná odmena v zmysle ustanovenia § 10 a nasl. vyhlášky Ministerstva spravodlivosti SR č. 655/2004 Z.z. o odmenách a náhradách advokátov za poskytovanie právnych služieb (ďalej len „tarifná odmena“). K tarifnej odmene sa pripočítava náhrada výdavkov na miestne telekomunikačné výdavky a miestne prepravné sumu vo výške jednej stotiny výpočtového základu za každý úkon právnej služby (režijný paušál), ktorý bude príkazcovi účtovaný v súlade s právnymi predpismi platnými v čase, kedy je úkon právnej služby vykonaný. Odmena advokáta je vypočítaná ako násobok počtu advokátom vykonaných úkonov právnej služby a tarifnej odmeny spolu s režijným paušálom (ďalej len „odmena advokáta“). K odmene advokáta sa pripočítava príslušná sadzba dane z pridanej hodnoty podľa aktuálnej právnej úpravy. Ustanovenie § 13a vyhlášky sa aplikuje analogicky.</li>
                <li>Príkazca potvrdzuje, že bol advokátom pred začatím poskytovania právnych služieb informovaný o výške tarifnej odmeny za úkon právnej služby a poučený o spôsobe výpočtu odmeny advokáta a tomuto spôsobu výpočtu porozumel a súhlasí s ním, čo potvrdzuje svojím podpisom na tejto zmluve. Príkazca zároveň potvrdzuje, že bol zároveň oboznámený o potrebe všetkých predpokladaných úkonov právnej služby, ktoré bude musieť advokát v budúcnosti vykonať v právnej veci vymáhania Pohľadávky.</li>
                <li>Advokát zároveň poučuje príkazcu, že v prípade neúspešného ukončenia právnej veci je príkazca povinný zaplatiť náhradu trov konania, zahŕňajúcu aj prípadné trovy právneho zastúpenia, účastníkovi, ktorý vo veci úspech mal.</li>
            </ol>
        </li>

        <li class="none">
            <h2 class="align-center">6. SPRACOVANIE OSOBNÝCH ÚDAJOV</h2>
            <ol class="pl-0 nested-counter">
                <li>Príkazca ako dotknutá osoba svojím podpisom na tejto zmluve slobodne, výslovne a zrozumiteľne potvrdzuje, že si je vedomá skutočnosti, že príkazník a advokát budú na účely plnenia tejto zmluvy spracovávať jej osobné údaje ako aj osobné údaje dlžníka v zmysle Nariadenia Európskeho parlamentu a Rady (EÚ) 2016/679 z 27.04.2016 o ochrane fyzických osôb pri spracúvaní osobných údajov a o voľnom pohybe takýchto údajov, ktorým sa zrušuje smernica 95/46/ES (všeobecné nariadenie o ochrane údajov) (ďalej len „Nariadenie GDPR“) a v zmysle zákona č. 18/2018 Z. z. o ochrane osobných údajov a o zmene a doplnení niektorých zákonov.</li>
                <li>Príkazca ako dotknutá osoba súčasne svojím podpisom potvrdzuje, že bol poučený a informovaný v zmysle článku 13 a nasl. Nariadenia GDPR a  § 19 a nasl. Zákona č. 18/2018 Z. z. o ochrane osobných údajov.</li>
            </ol>
        </li>

        <li class="none">
            <h2 class="align-center">7. OSTATNÉ USTANOVENIA</h2>
            <ol class="pl-0 nested-counter">
                <li>Práva a povinnosti príkazníka a advokáta podľa tejto zmluvy sú koncipované samostatne, a teda nie ako spoločné práva a spoločné záväzky.  </li>
                <li>Príkazca súhlasí, aby komunikácia podľa tejto zmluvy prebiehala prostredníctvom jeho zákazníckeho účtu na portáli www.vymozete.sk, prípadne e-mailom na emailovú adresu zadanú v zákazníckom účte.</li>
                <li>Zmluva môže byť zmenená alebo doplnená iba písomným dodatkom podpísaným všetkými stranami.</li>
                <li>Zmluva sa vyhotovuje v troch rovnopisoch, každý s platnosťou originálu. Každá zo zmluvných strán obdrží po jednom vyhotovení.</li>
                <li>Príkazca sa zaväzuje neuzavrieť po dobu trvania tejto zmluvy s akoukoľvek treťou osobou príkaznú zmluvu či obdobnú zmluvu, ktorej predmetom by bolo zariadenia či uskutočnenie záležitosti či jej časti, ako vyplýva z tejto zmluvy.</li>
                <li>Zmluva je uzatvorená ku dňu jej podpisu všetkými zmluvnými stranami a v rovnaký deň nadobúda účinnosť.  </li>
                <li>V prípade ak je príkazca spotrebiteľom, je neoddeliteľnou súčasťou tejto zmluvy poučenie spotrebiteľa podľa § 3 zák. č. 102/2014 Z. z. o ochrane spotrebiteľa pri predaji tovaru alebo poskytovaní služieb na základe zmluvy uzavretej na diaľku alebo zmluvy uzavretej mimo prevádzkových priestorov predávajúceho a o zmene a doplnení niektorých zákonov.</li>
                <li>Vzťahy neupravené touto zmluvou sa spravujú Všeobecne obchodnými podmienkami, ktoré sú neoddeliteľnou súčasťou tejto zmluvy.</li>
            </ol>
        </li>
    </ol>
    <br><br>
    <div class="podpisy">
        <table>
            <tr>
                <td class="width-half va-top">
                    V Bratislave dňa {{date('d.m.Y')}} <br><br><br><br><br>
                    ........................... <br>
                    <b>iVymáhanie s.r.o.</b> <br>
                    <b>JUDr. Michal Gálik, PhD.</b> <br>
                    <b>Konateľ</b> <br><br><br><br>

                    ........................... <br>
                    <b>BARKOCI law firm, s.r.o.</b> <br>
                    <b>JUDr. Stanislav Barkoci, PhD.</b> <br>
                    <b>konateľ a advokát</b>
                </td>
                <td class="width-half va-top">
                    V Bratislave dňa {{date('d.m.Y')}} <br><br><br><br><br>
                    ........................... <br>
                    <b>{{$claim->creditor->entity->fullName}}</b><br>
                    <b>Príkazca</b> <br>
                </td>
            </tr>
        </table>
    </div>

</main>
<footer>
    <img src="{{asset('images/footer_barkoci.png')}}" alt="yyy">
</footer>


<div class="page-break"></div>
<h1>Príloha č. 1 k príkaznej zmluve</h1>
<p>Pohľadávka príkazcu {{$claim->creditor->entity->fullName}} voči dlžníkovi {{$claim->debtor->entity->fullName}}, nar. {{$claim->creditor->entity->birthday}}, rodné číslo: {{$claim->creditor->entity->id_number}}, trvale bytom: {{$claim->creditor->entity->fullAddress}} vo výške:</p>
<p class="align-center">Istina {{$claim->amount}} Eur</p>
<p><br>VZNIK A VÝŠKA POHĽADÁVKY JE PREUKÁZANÁ  NÁSLEDUJÚCIMI DOKLADMI, NA KTORÝCH ZÁKLADE VZNIKLA:</p>
<h2 class="align-center">Ďalší dokument</h2>
<p>V Bratislave dňa:  {{date('d.m.Y')}}</p>
<br><br><br><br><br>
<p>
    ....................................<br>
    {{$claim->creditor->entity->fullName}}<br>
    Príkazca
</p>

<div class="page-break"></div>
<h1 class="align-center">Oznámenie spotrebiteľovi v súvislosti s príkaznou zmluvou uzatvorenou na diaľku alebo mimo prevádzkových priestorov príkazníka a/alebo advokáta medzi:</h1>

<table class="bordered">
    <tr>
        <td class="width-half va-top">
            <ol class="pl-20 pr-5">
                <li>
                    Meno a priezvisko: {{$claim->creditor->entity->fullName}}<br>
                    Dátum narodenia: {{$claim->creditor->entity->birthday}}<br>
                    Rodné číslo: {{$claim->creditor->entity->id_number}}<br>
                    Trvalý pobyt: {{$claim->creditor->entity->fullAddress}}<br>
                    Št. občianstvo: {{$claim->creditor->entity->citizenship}}<br>
                    (ďalej len „<b>príkazca</b>“)
                </li>
            </ol>
        </td>
        <td class="width-half va-top">
            <ol class="pl-20 pr-5">
                <li class="none"></li>
                <li>
                    <b>iVymáhanie s.r.o.</b><br>
                    so sídlom Zámocká 30, 811 01 Bratislava, zapísaná v Obchodnom registri vedenom Okresným súdom Bratislava I, oddiel: Sro, vložka č. 123274/B<br>
                    IČO: 51 025 876<br>
                    Konajúca prostr.: JUDr. Michal Gálik, PhD. – konateľ; Ing. Andrea Jakubcová – konateľ<br>
                    (ďalej len „<b>príkazník</b>“)<br>
                </li>
                <p>a</p>
                <li>
                    <b>BARKOCI law firm, s.r.o.</b><br>
                    so sídlom Námestie slobody 28, 811 06 Bratislava – Staré Mesto, zapísaná v Obchodnom  registri: Okresného súdu Bratislava I, Oddiel: Sro, Vložka číslo: 88740/B<br>
                    IČO: 47 247 916<br>
                    DIČ: SK2024164934<br>
                    IČ DPH: SK2024164934<br>
                    Konajúca prostr.: JUDr. Stanislav Barkoci, PhD. – konateľ a advokát<br>
                    (ďalej len „<b>advokát</b>“)<br>
                </li>
            </ol>
        </td>
    </tr>
</table>

<table style="border-collapse: collapse; margin-top: 10px;">
    <tr class="border-bottom">
        <td class="width-half va-top"><b>Kto nesie náklady na prostriedky komunikácie na diaľku?</b></td>
        <td class="pb-10 align-justify">Náklady na prostriedky komunikácie na diaľku, ktoré príkazcovi vznikli v súvislosti s uzatvorením a plnením príkaznej zmluvy a prijatím služby, sú jeho vlastnými nákladmi a nesie si ich sám. V praxi sú tieto náklady predstavované poštovným v súvislosti s odoslaním podpísanej príkaznej zmluvy príkazníka.</td>
    </tr>
    <tr class="border-bottom">
        <td class="width-half va-top"><b>Je nutné hradiť zálohu v súvislosti s vymáhaním pohľadávky?</b></td>
        <td class="pb-10 align-justify">V procese plnenia príkaznej zmluvy, teda vymáhania pohľadávky, bude v prípade súdneho vymáhania pohľadávky nutné uhradiť súdny poplatok vo výške podľa platných právnych predpisov. Ďalej nemožno vylúčiť, že v rámci súdneho vymáhania nároku súd uloží žalobcovi povinnosť uhradiť preddavok na vykonanie dôkazu, najmä znaleckého posudku.</td>
    </tr>
    <tr class="border-bottom">
        <td class="width-half va-top"><b>Je možné od príkaznej zmluvy odstúpiť?</b></td>
        <td class="pb-10 align-justify">Od príkaznej zmluvy uzavretej na diaľku alebo uzavretej mimo prevádzkových priestorov príkazcu a/alebo advokáta máte právo odstúpiť bez udania dôvodu, a to do 14 dní od jej uzavretia. Právo na odstúpenie od príkaznej zmluvy uplatníte tak, že nás o odstúpení od zmluvy informujete písomne listom odoslaným na adresu iVymáhanie s.r.o., so sídlom Zámocká 34, 811 01 Bratislava. Možno použiť formulár na odstúpenie uvedený nižšie. Pre dodržanie lehoty je nutné, aby poštová zásielka s písomným odstúpením bola odoslaná najneskôr v posledný deň 14-dňovej lehoty na odstúpenie. Ak odstúpite od príkaznej zmluvy v 14-dňovej lehote, vrátime vám bez zbytočného odkladu všetky platby, ktoré sme prípadne od vás dostali; toto však neplatí, ak sme boli vami požiadaní, aby sme s vymáhaním pohľadávky začali pred uplynutím 14-dňovej lehoty na odstúpenie. V takom prípade má advokát nárok na úhradu odmeny za dovtedy vykonané úkony právnej služby vo výške podľa vyhlášky MS SR č. 655/2004 Z. z. v platnom znení.</td>
    </tr>
    <tr class="border-bottom">
        <td class="width-half va-top"><b>Informácia o možnosti a podmienkach riešenia sporu prostredníctvom systému alternatívneho riešenia sporov; odkaz na platformu alternatívneho riešenia sporov, prostredníctvom ktorej môže spotrebiteľ podať návrh na začatie alternatívneho riešenia sporu:</b></td>
        <td class="pb-10 align-justify">Alternatívne riešenie sporov z príkaznej zmluvy je možné prostredníctvom subjektu alternatívneho riešenia sporov; Subjektom alternatívneho riešenia sporov je orgán alternatívneho riešenia sporov alebo právnická osoba zapísaná v zozname podľa § 5 ods. 2 zákona č. 391/2015 Z .z., riešenie sporov uvedeným spôsobom je založené na dobrovoľnej účasti obidvoch strán, objektivite a nestrannosti konania; subjektom alternatívneho riešenia sporov vo vzťahu k príkazníkovi je Slovenská obchodná inšpekcia. Odkaz na platformu alternatívneho riešenia sporov prostredníctvom ktorej môže príkazca podať návrh na začatie alternatívneho riešenia sporu:  https://www.soi.sk/sk/Alternativne-riesenie-spotrebitelskych-sporov.soi , ktorý je súčasne uvedený aj na webovom sídle príkazníka).</td>
    </tr>
</table>

<div class="page-break"></div>
<h2>Vzorový formulár pre odstúpenie od zmluvy:</h2>
<table class="bordered">
    <tr>
        <td style="width: 260px" class="padding-around height-40"><b>Adresát:</b></td>
        <td>iVymáhanie s.r.o., Zámocká 34, 811 01 Bratislava</td>
    </tr>
    <tr>
        <td style="width: 260px" class="padding-around height-40"><b>Text odstúpenia:</b></td>
        <td>Oznamujem, že týmto odstupujem od príkaznej zmluvy mnou podpísanej dňa {{date('d.m.Y')}}</td>
    </tr>
    <tr>
        <td style="width: 260px" class="padding-around height-40"><b>Vaše meno a priezvisko:</b></td>
        <td>{{$claim->creditor->entity->fullName}}</td>
    </tr>
    <tr>
        <td style="width: 260px" class="padding-around height-40"><b>Vaša adresa:</b></td>
        <td>{{$claim->creditor->entity->fullAddress}}</td>
    </tr>
    <tr>
        <td style="width: 260px" class="padding-around height-40"><b>Dátum:</b></td>
        <td>{{date('d.m.Y')}}</td>
    </tr>
    <tr>
        <td style="width: 260px" class="height-40"><b>Váš podpis:</b></td>
        <td></td>
    </tr>
</table>
<br><br>
<p>Potvrdzujem, že som poučeniu porozumel,</p>
<p>V Bratislave dňa:  {{date('d.m.Y')}}</p>
<br><br><br><br><br>
<p>
    ....................................<br>
    {{$claim->creditor->entity->fullName}}<br>
    Príkazca
</p>

<div class="page-break"></div>
<h1 class="align-center">PLNÁ MOC</h1>
<p class="align-center">
    Meno a priezvisko: {{$claim->creditor->entity->fullName}},<br>
    Dátum narodenia: {{$claim->creditor->entity->birthday}}, Rodné číslo: {{$claim->creditor->entity->id_number}},<br>
    Trvalý pobyt: {{$claim->creditor->entity->fullAddress}}, Št. občianstvo: {{$claim->creditor->entity->citizenship}}<br>
    (ďalej len „splnomocniteľ“)
</p>
<h2 class="align-center">týmto splnomocňuje</h2>
<p class="align-center">
    advokátsku kanceláriu <b>BARKOCI law firm, s. r. o.</b>, so sídlom Námestie slobody 28, Bratislava-Staré Mesto 811 06, zapísaná v Obchodnom  registri: Okresného súdu Bratislava I, Oddiel: Sro, Vložka číslo: 88740/B, IČO: 47 247 916, konajúca prostredníctvom: JUDr. Stanislav Barkoci, PhD., advokát a konateľ <br>
    (ďalej len „splnomocnenec“)
</p>
<p>na všetky úkony v právnej veci splnomocniteľa ako veriteľa smerujúce k úhrade a vymoženiu pohľadávky splnomocniteľa vo výške {{$claim->amount}} EUR s príslušenstvom zo strany dlžníka {{$claim->debtor->entity->fullName}}, nar. {{$claim->debtor->entity->birthday}}, rodné číslo: {{$claim->debtor->entity->id_number}}, trvale bytom: {{$claim->debtor->entity->fullAddress}} a uplatneniu všetkých nárokov splnomocniteľa spojených s jeho pohľadávkou.</p>

<p>Vo vyššie uvedenej veci splnomocniteľ splnomocňuje splnomocnenca, aby ho vo všetkých právnych veciach zastupoval, aby vykonával všetky úkony, prijímal doručované písomnosti, podával návrhy a žiadosti, uzavieral zmiery, uznával uplatnené nároky, vzdával sa nárokov, podával opravné prostriedky, vzdával sa ich, vymáhal nároky, plnenie nárokov prijímal, ich plnenie potvrdzoval, a to všetko i vtedy, keď je podľa právnych predpisov potrebné osobitné splnomocnenie. Splnomocnenie sa vzťahuje na právne úkony týkajúce sa mimosúdneho, súdneho a exekučného konania.</p>
<p>Toto splnomocnenie splnomocniteľ udeľuje v rozsahu práv a povinností podľa Civilného sporového poriadku, Občianskeho zákonníka, Obchodného zákonníka, Exekučného poriadku a súvisiacich predpisov. </p>
<p>Splnomocniteľ súhlasí s tým, aby bol zastúpený advokátskym koncipientom splnomocnenca.</p>
<p>Splnomocniteľ súhlasí, aby splnomocnenec ustanovil za seba zástupcu, ktorý je oprávnený konať v celom rozsahu tejto plnej moci.</p>
<p>Svojím podpisom splnomocniteľ ako klient potvrdzuje, že bol splnomocnencom ako advokátom informovaný o výške tarifnej odmeny za úkony právnej služby poskytovanej splnomocnencom ako advokátom, a to ešte pred začatím poskytovania právnych služieb. Splnomocniteľ bol zároveň oboznámený o potrebe všetkých predpokladaných úkonov právnej služby, ktoré bude musieť splnomocnenec v budúcnosti vykonať v predmetnej právnej veci, ako aj o predpokladanom časovom rozpätí potrebnom na vykonanie jednotlivých úkonov právnej služby.</p>
<p>V Bratislave dňa {{date('d.m.Y')}}</p>

</body>
</html>
