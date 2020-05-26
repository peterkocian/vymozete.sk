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

{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Login') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
