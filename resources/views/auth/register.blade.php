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
                    @error('email')
                        <span class="validation-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="group">
                    <label for="password">Heslo *</label>
                    <input id="password" name="password" required="required" type="password" autocomplete="new-password">
                    <span class="bar"></span>
                    @error('password')
                        <span class="validation-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="group">
                    <label for="password-confirm">Zopakujte heslo *</label>
                    <input id="password-confirm" name="password_confirmation" required="required" type="password" autocomplete="new-password">
                    <span class="bar"></span>
                </div>

                <div class="group">
                    <label for="phone">Telefónne číslo pre SMS notifikácie</label>
                    <input id="phone" name="phone" type="text" placeholder="Vo formáte +421911222333" value="{{ old('phone') }}">
                    <span class="bar"></span>
                    @error('phone')
                        <span class="validation-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="group">
                    <div class="row">
                        <p>
                            <input type="checkbox" value="1" name="vop" required="required" @if(old('vop') == 1) checked @endif>
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
@endsection
