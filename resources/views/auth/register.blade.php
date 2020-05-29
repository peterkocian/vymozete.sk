@extends('front.layout')

@section('content')
    <div class="mainbox mainbox_white">
        <div class="row"><h1>Registrácia</h1></div>

        <div class="form_box">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="group">
                    <h4>Registrácia nového používateľa</h4>
                </div>

                <div class="group">
                    <label for="email">E-mail *</label>
                    <input id="email" name="email" required="required" type="email" autocomplete="off" value="{{ old('email') }}">
                    <span class="bar"></span>
                </div>

                <div class="group">
                    <label for="password">Heslo *</label>
                    <input id="password" name="password" required="required" type="password" autocomplete="new-password">
                    <span class="bar"></span>
                </div>

                <div class="group">
                    <label for="password-confirm">Zopakujte heslo *</label>
                    <input id="password-confirm" name="password_confirmation" required="required" type="password" autocomplete="new-password">
                    <span class="bar"></span>
                </div>

                <div class="group">
                    <label for="phone">Telefónne číslo pre SMS notifikácie</label>
                    <input id="phone" name="phone" type="text" pattern="\+\d{12}" placeholder="Vo formáte +421911222333" value="{{ old('phone') }}">
                    <span class="bar"></span>
                </div>

                @if ($errors->any())
                    <div class="group">
                        <div class="row">
                            <div class="message">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="group">
                    <div class="row">
                        <p>
                            <input type="checkbox" value="1" name="vop" required="required">
                                Súhlasím so <a target="_blank" href="{{ url('/vop') }}"><b>Všeobecnými podmienkami používania služby (VOP)</b></a> *
                        </p>
                    </div>
                    <div class="row"><button class="big_btn" type="submit" value="REGISTROVAŤ">registrovať</button></div>
                    <div class="row"><p><a href="{{ url('/login') }}"><b>Prihlásenie</b></a> / <a href="{{ url('/password/reset') }}"><b>Zabudnuté heslo</b></a></p></div>
                </div>

                <div class="group">
                    <div class="row">
                        <i>* označuje povinné údaje</i>
                    </div>
                </div>
            </form>
        </div>

        <div class="form_box">
            <div class="group">
                <h4>Prečo sa registrovať</h4>
                <p>Aby ste mohli pridávať a spravovať Vaše pohľadávky, potrebujete sa zaregistrovať.</p>
                <p>Použite Vašu emailovú adresu a vytvorte si heslo. Pomocou týchto údajom sa potom budete môcť kedykoľvek prihlásiť.</p>
                <p>Heslo si môžete kedykoľvek zmeniť. Ak heslo zabudnete, môžete si nastaviť nové pomocou Vašej <a href="{{ url('/password/reset') }}"><b>emailovej adresy</b></a>.</p>
            </div>
        </div>
    </div>

{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-8">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">{{ __('Register') }}</div>--}}

{{--                    <div class="card-body">--}}
{{--                        <form method="POST" action="{{ route('register') }}">--}}
{{--                            @csrf--}}

{{--                            <div class="form-group row">--}}
{{--                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{--                                    @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group row">--}}
{{--                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

{{--                                    @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group row">--}}
{{--                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                    @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group row">--}}
{{--                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group row mb-0">--}}
{{--                                <div class="col-md-6 offset-md-4">--}}
{{--                                    <button type="submit" class="btn btn-primary">--}}
{{--                                        {{ __('Register') }}--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
