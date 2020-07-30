@extends('front.layout')

@section('content')
    <div class="mainbox mainbox_white">
        <div class="row"><h1>Zabudnuté heslo</h1></div>

        <div class="form_box">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST"  action="{{ route('password.email') }}">
                @csrf

                <div class="group">
                    <h4>Zmeniť heslo</h4>
                </div>

                <div class="group">
                    <label for="email">E-mail</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <span class="bar"></span>
                </div>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="group">
                    <div class="row">
                        <button class="big_btn" type="submit" value="RESET">poslať mail</button>
                    </div>
                    <div class="row"><p><a href="{{ url('/login') }}"><b>Prihlásenie</b></a> / <a href="{{ url('/register') }}"><b>Registrácia</b></a></p></div>
                </div>
            </form>
        </div>

        <div class="form_box">
            <div class="group">
                <h4>Postup pri reset hesla</h4>
                <p>Ak ste zabudli svoje heslo, alebo si svoje heslo chcete zmeniť, zadajte emailovú adresu, ktorú ste použili pri registrácii.</p>
                <p>Následne Vám bude odoslaný email na vygenerovanie nového hesla. Postupujte prosím podľa inštrukcií v emailovej správe.</p>
            </div>
        </div>
    </div>
@endsection
