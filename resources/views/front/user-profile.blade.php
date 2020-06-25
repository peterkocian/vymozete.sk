@extends('front.layout')

@section('content')
    <div class="mainbox mainbox_white">
        <div class="row"><h1>Údaje užívateľa</h1></div>

        <div class="form_box">
            <form method="POST" action="">

                <div class="group">
                    <h4>Upravte svoje údaje</h4>
                </div>

                <div class="group">
                    <input id="name" name="data[name]" type="text" value="">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label for="name">Meno</label>
                </div>

                <div class="group">
                    <input id="email" name="data[email]" required="required" type="email" value="">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label for="email">E-mail</label>
                </div>

                <div class="group">
                    <input id="telefon" name="data[phone]" type="text" value="" pattern="\+[0-9]{12}">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label for="telefon">Mobil (v tvare +4219xxyyyyyy)</label>
                </div>

                <div class="group">
                    <div class="row">
                        <button class="big_btn" type="submit">uložiť</button>
                    </div>
                    <div class="row"><p><a href="{{ route('front.home') }}"><b>zavrieť bez zmeny</b></a></p></div>
                </div>
            </form>
        </div>

        <div class="form_box">
            <div class="group">
                <h4>Udržujte Vaše kontakty aktuálne</h4>
                <p>Vaše kontaktné údaje (email a telefónne číslo) slúžia na primárnu komunikáciu s Vami. Udržujte ich prosím
                    aktuálne, aby sme Vám mohli zasielať informácie o zmenách v procese vymáhania Vašich pohľadávok.</p>
            </div>
        </div>
    </div>
@endsection

