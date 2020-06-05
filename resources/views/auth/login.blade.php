@extends('front.layout')

@section('content')
    <div class="mainbox mainbox_white">
        <div class="row"><h1>Prihlásenie</h1></div>

        <div class="form_box">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="group">
                    <h4>Prihlásenie používateľa</h4>
                </div>

                <div class="group">
                    <label for="email">E-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <span class="bar"></span>
                </div>

                <div class="group">
                    <label for="password">Heslo</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password">
                    <span class="bar"></span>
                </div>

                @if ($errors->any())
                    <div class="group">
                        @foreach ($errors->all() as $error)
                            <div class="row">
                                <span class="message">{{ $error }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="group">
                    <div class="row"><button class="big_btn" type="submit" value="PRIHLÁSIŤ">prihlásiť</button></div>
                    <div class="row"><p><a href="{{ url('/register') }}"><b>Registrácia</b></a> / <a href="{{ url('/password/reset') }}"><b>Zabudnuté heslo</b></a></p></div>
                </div>
            </form>
        </div>

        <div class="form_box">
            <div class="group">
                <h4>Klientská zóna</h4>
                <p>Pre pokračovanie sa prosím prihláste do Vášho účtu pomocou emailu a hesla, ktoré ste si nastavili pri registrácii.</p>
                <p>Ak ešte nemáte konto, môžete sa <a href="{{ url('/register') }}"><b>bezplatne zaregistrovať</b></a>.</p>
                <p>Ak si nepamätáte svoje heslo, môžete si nastaviť nové pomocou Vašej <a href="{{ url('/password/reset') }}"><b>emailovej adresy</b></a>.</p>
            </div>
        </div>
    </div>
@endsection
