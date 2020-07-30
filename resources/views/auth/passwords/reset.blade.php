@extends('front.layout')

@section('content')
    <div class="mainbox mainbox_white">
        <div class="row"><h1>{{ __('general.Reset Password') }}</h1></div>

        <div class="form_box">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST"  action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="group">
                    <label for="email">E-mail</label>
                    <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email">
                    <span class="bar"></span>
                    @error('email')
                        <span class="validation-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="group">
                    <label for="email">Nové heslo</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password">
                    <span class="bar"></span>
                    @foreach ($errors->get('password') as $message)
                        <div class="validation-error">{{ $message }}</div>
                    @endforeach
                </div>

                <div class="group">
                    <label for="email">Potvrdenie hesla</label>
                    <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                    <span class="bar"></span>
                </div>

                <div class="group">
                    <div class="row">
                        <button class="big_btn" type="submit" value="RESET">{{ __('general.Set new password') }}</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="form_box">
            <div class="group">
                <h4>Ako nastaviť nové heslo</h4>
                <p>Nové heslo musí obsahovať minimálne 6 znakov.</p>
                <p>Heslo zadané do položky <b>Nové heslo</b> a položky <b>Potvrdenie hesla</b> sa musí zhodovať.</p>
            </div>
        </div>
    </div>
@endsection
