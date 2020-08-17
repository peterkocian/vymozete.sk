<ul class="nav nav-tabs">
    {{--    <nav>--}}
    {{--        <div class="nav nav-tabs" id="nav-tab" role="tablist">--}}
    {{--            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>--}}
    {{--            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>--}}
    {{--            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>--}}
    {{--        </div>--}}
    {{--    </nav>--}}
    <li class="nav-item">
        <a class="nav-link @if($tab === 'overview') active @endif" href="{{route('admin.claims.overview', $claim->id ?? "")}}">Prehľad</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($tab === 'creditor') active @endif" href="{{route('admin.claims.creditor', $claim->id ?? "")}}">Veriteľ</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($tab === 'debtor') active @endif" href="{{route('admin.claims.debtor', $claim->id ?? "")}}">Dlžník</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($tab === 'documents') active @endif" href="{{route('admin.claims.documents', $claim->id ?? "")}}">Dokumenty</a>
    </li>
    {{--    <li class="nav-item">--}}
    {{--        <a class="nav-link" href="{{route('admin.claims.documents', $claim->id)}}">Dokumenty</a>--}}
    {{--    </li>--}}
    {{--    <li class="nav-item">--}}
    {{--        <a class="nav-link" href="{{route('admin.claims.property', $claim->id)}}">Majetok</a>--}}
    {{--    </li>--}}
    {{--    <li class="nav-item">--}}
    {{--        <a class="nav-link" href="{{route('admin.claims.lustration', $claim->id)}}">Lustrácia</a>--}}
    {{--    </li>--}}
    {{--    <li class="nav-item">--}}
    {{--        <a class="nav-link" href="{{route('admin.claims.calc', $claim->id)}}">Kalkulácia</a>--}}
    {{--    </li>--}}
    {{--    <li class="nav-item">--}}
    {{--        <a class="nav-link" href="{{route('admin.claims.notes', $claim->id)}}">Poznámky</a>--}}
    {{--    </li>--}}
    {{--    <li class="nav-item">--}}
    {{--        <a class="nav-link" href="{{route('admin.claims.cal', $claim->id)}}">Kalendár</a>--}}
    </li>
</ul>
