@extends('front.layout')

@section('content')
    <div class="mainbox mainbox_white">
        <div class="row"><h1>Údaje používateľa</h1></div>

        <div class="form_box">
            <form method="POST" action="{{route('front.users.updateProfile', $user->id)}}">
                @csrf
                @method('put')

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
                    <label for="phone">Mobil (v tvare +4219xxyyyyyy)</label>
                    <input id="phone" name="phone" type="text" value="{{ $user->phone }}" pattern="\+[0-9]{12}">
                    <span class="bar"></span>
                </div>

                <div class="group">
                    <label for="language">Jazyk</label>
                    <select id="language" name="language_id" required="required">
                        @foreach($languages as $language)
                            <option value="{{$language->id}}"
                                @if($user->language && $user->language->id === $language->id)selected="selected"@endif
                            >{{$language->name}}</option>
                        @endforeach
                    </select>
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

