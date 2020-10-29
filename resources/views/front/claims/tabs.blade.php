<ul class="nav-tabs-container">
    <li class="tab-item">
        <a class="tab-link @if($tab === 'overview') active @endif" href="{{route('front.claims.overview', $claim_id ?? "")}}">Prehľad</a>
    </li>
    <li class="tab-item">
        <a class="tab-link @if($tab === 'debtor') active @endif" href="{{route('front.claims.debtor', $claim_id ?? "")}}">Dlžník</a>
    </li>
    <li class="tab-item">
        <a class="tab-link @if($tab === 'creditor') active @endif" href="{{route('front.claims.creditor', $claim_id ?? "")}}">Veriteľ</a>
    </li>
    <li class="tab-item">
        <a class="tab-link @if($tab === 'documents') active @endif" href="{{route('front.claims.documents.allByClaimId', $claim_id ?? "")}}">Prílohy</a>
    </li>
</ul>
