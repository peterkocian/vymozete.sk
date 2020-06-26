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
                    <label for="name">Meno</label>
                    <input id="name" name="name" type="text" value="{{ $user->name }}">
                    <span class="bar"></span>
                </div>

                <div class="group">
                    <label for="name">Priezvisko</label>
                    <input id="name" name="surname" type="text" value="{{ $user->surname }}">
                    <span class="bar"></span>
                </div>

                <div class="group">
                    <label for="email">E-mail</label>
                    <input id="email" name="email" type="email" value="{{ $user->email }}" required="required">
                    <span class="bar"></span>
                </div>

                <div class="group">
                    <label for="telefon">Mobil (v tvare +4219xxyyyyyy)</label>
                    <input id="telefon" name="phone" type="text" value="{{ $user->phone }}" pattern="\+[0-9]{12}">
                    <span class="bar"></span>
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

