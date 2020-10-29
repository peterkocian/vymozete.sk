@extends('front.layout')

@section('content')
    <div class="mainbox mainbox_white">
        <div class="row done">
            Vaša pohľadávka bola úspešne zaevidovaná.<br>
            Po vykonaní kontroly bonity dlžníka Vás budeme kontaktovať.<br>
            Pokračovať môžete kliknutím na prehľad Vašich pohľadávok.
        </div>
        <div>
            <a class="big_btn" href="{{route('front.home')}}">Moje pohľadávky</a>
        </div>
    </div>
@endsection
