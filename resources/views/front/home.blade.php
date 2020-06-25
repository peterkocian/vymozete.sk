@extends('front.layout')

@section('content')
    <div class="mainbox mainbox_white zoznam-pohladavok">

        <div class="row"><h1>Moje pohľadávky</h1></div>
        <div class="row"><p>
            <a href="{{ route('front.claim') }}"><b>Pridať novú pohľadávku</b></a>
            &nbsp;/ <a href="{{ route('front.users.editProfile', Auth::id()) }}"><b>Upraviť moje údaje</b></a></p>
        </div>

        <div class="row"><h4>Všetky Vaše pohľadávky</h4></div>

{{--        <? foreach ($claims as $claim): ?>--}}
        <div class="pohladavka table-responsive">
            <table class="table table-sm table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">dátum vytvorenia</th>
                    <th scope="col">veriteľ</th>
                    <th scope="col">dlžník</th>
                    <th scope="col">dlžná suma</th>
                    <th scope="col">stav</th>
                    <th scope="col">súbory</th>
                    <th scope="col">akcie</th>
                </tr>
                </thead>
                <tbody>
                @foreach($claims as $claim)
                <tr>
                    <th scope="row">1</th>
                    <td>{{ $claim->created_at }}</td>
                    <td>Otto</td>
                    <td>Miso</td>
                    <td>{{ $claim->amount }}</td>
                    <td>@mdo</td>
                </tr>
                @endforeach
                </tbody>
            </table>
{{--            <div class="pohladavka_item">--}}
{{--                <p>dátum zadania</p>--}}
{{--                <p><b>xxx</b></p>--}}

{{--                <p>veriteľ</p>--}}
{{--                <p><b>xxx</b></p>--}}

{{--                <p>dlžník</p>--}}
{{--                <p><b>xxx</b></p>--}}

{{--                <p>dlžná suma</p>--}}
{{--                <p><b>xxx</b></p>--}}

{{--                <p>stav</p>--}}
{{--                <p><b>xxx</b></p>--}}

{{--                <p>súbory</p>--}}
{{--                <p class="files">--}}
{{--                </p>--}}

{{--                <p>--}}
{{--                    <form method="POST" action="/" enctype="multipart/form-data">--}}
{{--                        <input type="hidden" name="id" value="xxx">--}}
{{--                        <input type="file" name="file">--}}
{{--                        <button type="submit">Nahrať</button>--}}
{{--                    </form>--}}
{{--                </p>--}}

{{--                <?// if (in_array($claim['cisStatus'], [\models\Claims::STATUS_INCOMPLETE, \models\Claims::STATUS_PENDING])): ?>--}}
{{--                <p>možnosti</p>--}}
{{--                <a href="/"><b>upraviť</b></a>--}}
{{--                <?// endif; ?>--}}

{{--            </div>--}}

        </div>
{{--        <? endforeach; ?>--}}

    </div>
@endsection
