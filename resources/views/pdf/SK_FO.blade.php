<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Splátkový kalendár</title>
    <style>
        html {
            /*size: 7in 9.25in;*/
            size: 21cm 29.7cm;
            margin: 10mm 16mm 27mm 16mm;
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
        .creditor-info, .debtor-info {
            padding-left: 60px;
        }
        .sign-container {
            max-width: 500px;
            margin: 40px auto 0 auto;
        }
        .creditor-sign{
            float: left;
            text-align: left;
            width: 150px;
        }
        .debtor-sign {
            float: right;
            text-align: left;
            width: 150px;
        }
        .sign {
            margin-top: 40px;
            width: 150px;
            text-align: center;
            /*height: 60px;*/
            border-top: 1px black solid;
        }
    </style>
</head>
<body>
    <main>
        <h1 style="text-align: center">Uznanie záväzku a dohoda o splátkovom kalendári</h1>
        <h2 style="text-align: center">Čl. I</h2>
        <h2 style="text-align: center">Strany dohody</h2>
        <b>1. Veriteľ:</b>
        <div class="creditor-info">
            {{$claim->creditor->entity->fullName}} <br>
            {{$claim->creditor->entity->fullAddress}} <br>
        </div>
        <b>Zastúpený: AK</b><br>
        (ďalej „<b>veriteľ</b>“) <br><br>
        <b>2. Dlžník:</b>
        <div class="debtor-info">
            {{$claim->debtor->entity->fullName}} <br>
            {{$claim->debtor->entity->fullAddress}} <br>
        </div>
        (ďalej „<b>dlžník</b>“)

        <h2 style="text-align: center">Čl. II</h2>
        <h2 style="text-align: center">Predmet dohody, uznanie dlhu</h2>
        <ol>
            <li>V zmysle tejto dohody dlžník týmto uznáva v súlade s ustanovením §558 zák.č. 40/1964 Zb. Občiansky zákonník v znení neskorších predpisov svoj dlh špecifikovaný v čl. III tejto dohody čo do dôvodu a výšky a zaväzuje sa ho zaplatiť v zmysle čl. IV tejto dohody.</li>
        </ol>

        <h2 style="text-align: center">Čl. III</h2>
        <h2 style="text-align: center">Špecifikácia záväzku dlžníka</h2>
        <p>Dlžník vyhlasuje, že má voči veriteľovi splatný záväzok vzniknutý z titulu:</p>
        <ul>
            <li>{typ}</li>
            <li>V sume: {amount} Eur</li>
            <li>Úroky z omeškania ku dňu {datum}: {urok} Eur</li>
            <li>Náklady veriteľa vynaložené na právne zastúpenie vypočítanú podľa vyhlášky MS SR č. 655/2004 Z. z.  ku dňu {datum}: {trovy} Eur</li>
        </ul>

        <h2 style="text-align: center">Čl. IV</h2>
        <h2 style="text-align: center">Splátkový kalendár</h2>
        <ol>
            <li>Dlžník sa zaväzuje uhradiť svoj dlh vo výške <b>{total} Eur</b> voči veriteľovi nasledovne:</li>
            <table>
                <thead>
                    <tr>
                        <th>SPLÁTKA</th>
                        <th>SPLATNOSŤ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>200 EUR</td>
                        <td>20.10.2020</td>
                    </tr>
                    <tr>
                        <td>200 EUR</td>
                        <td>20.10.2020</td>
                    </tr>
                    <tr>
                        <td>200 EUR</td>
                        <td>20.10.2020</td>
                    </tr>
                    <tr>
                        <td>200 EUR</td>
                        <td>20.10.2020</td>
                    </tr>
                </tbody>
            </table>
            <li>Veriteľ s plnením svojej pohľadávky formou splátkového kalendára podľa podmienok v čl. IV ods. 1 tejto dohody súhlasí.</li>
            <li>Dlžník zároveň berie na vedomie, že v prípade nesplnenia ktorejkoľvek splátky stáva sa splatným celý dlh a dlžník stráca výhodu splátok, pričom veriteľ je oprávnený požadovať úhradu celého neuhradeného zostatku pohľadávky.</li>
            <li>V prípade, že dlžník bude mať dostatok finančných prostriedkov, je oprávnený splniť dlh, príp. jednotlivú splátku vo vyššej sume ako aj v skoršom termíne.</li>
            <li>Pokiaľ dlžník poruší dohodnutý splátkový kalendár, veriteľ je oprávnený žiadať od dlžníka zaplatenie úrokov z omeškania, ktoré vzniknú odo dňa porušenia splátkového kalendára, pričom dlžník je povinný tieto úroky veriteľovi uhradiť.  </li>
            <li>Dlžník bude uhrádzať jednotlivé splátky podľa dohodnutého splátkového kalendára bankovým prevodom na bankový účet: iVymáhanie s.r.o., Zámocká 30, 811 01 Bratislava IBAN: <b>{iban}</b></li>
            <li>Jednotlivé  splátky podľa splátkového kalendára sa považujú za splnené dňom pripísania uhradenej sumy na účet.</li>
        </ol>

        <h2 style="text-align: center">Čl. V</h2>
        <h2 style="text-align: center">Záverečné ustanovenia</h2>
        <ol>
            <li>Dohoda nadobúda platnosť a účinnosť podpísaním oboma zmluvnými stranami.</li>
            <li>Dohoda je vyhotovená v 2 exemplároch, z ktorých každá strana dohody obdrží jedno vyhotovenie.</li>
            <li>Vzťahy medzi veriteľom a dlžníkom touto dohodou neupravené sa riadia podľa všeobecne platných právnych predpisov SR, najmä príslušnými ustanoveniami Občianskeho zákonníka.</li>
            <li>Strany dohody vyhlasujú, že si znenie tejto dohody prečítali, rozumejú jej obsahu a na znak súhlasu s ustanoveniami tejto dohody strany dohody pripájajú vlastnoručné podpisy  ako vyjadrenie ich slobodnej a vážnej vôle.</li>
        </ol>
        <div class="sign-container">
            <div class="creditor-sign">
                V Bratislave dňa ................... <br>
                <div class="sign">
                    <b>veriteľ AK</b>
                </div>

            </div>
            <div class="debtor-sign">
                V Bratislave dňa ................... <br>
                <div class="sign">
                    <b>dlžník</b>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
