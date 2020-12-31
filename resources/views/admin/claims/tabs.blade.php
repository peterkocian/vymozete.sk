<ul class="nav nav-tabs nav-tabs-custom">
    <li class="nav-item">
        <a class="nav-link @if($tab === 'overview') active @endif" href="{{route('admin.claims.overview', $claim_id ?? "")}}">Prehľad</a>
    </li>
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link @if($tab === 'creditor') active @endif" href="{{route('admin.claims.creditor', $claim_id ?? "")}}">Veriteľ</a>--}}
{{--    </li>--}}
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link @if($tab === 'debtor') active @endif" href="{{route('admin.claims.debtor', $claim_id ?? "")}}">Dlžník</a>--}}
{{--    </li>--}}
    <li class="nav-item">
        <a class="nav-link @if($tab === 'documents') active @endif" href="{{route('admin.claims.documents.allByClaimId', $claim_id ?? "")}}">Dokumenty</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($tab === 'properties') active @endif" href="{{route('admin.claims.properties.allByClaimId', $claim_id ?? "")}}">Majetok</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($tab === 'calculations') active @endif" href="{{route('admin.claims.calculations.allByClaimId', $claim_id ?? "")}}">Kalkulácia</a>
    </li>
    {{--    <li class="nav-item">--}}
    {{--        <a class="nav-link" href="{{route('admin.claims.lustration', $claim_id ?? "")}}">Lustrácia</a>--}}
    {{--    </li>--}}
    <li class="nav-item">
        <a class="nav-link @if($tab === 'notes') active @endif" href="{{route('admin.claims.notes.allByClaimId', $claim_id ?? "")}}">Poznámky</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($tab === 'calendar') active @endif" href="{{route('admin.claims.calendar.allByClaimId', $claim_id) ?? ""}}">Splátkový kalendár</a>
    </li>
</ul>
