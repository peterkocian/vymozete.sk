@extends ('admin.layouts.app')
@section ('content')
    @include('admin.claims.tabs')
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade @if($tab === 'overview') show active @endif" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            @if($tab === 'overview')
                @include('admin.claims.tabs.overview')
            @endif
        </div>
        <div class="tab-pane fade @if($tab === 'creditor') show active @endif" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            @if($tab === 'creditor')
                @include('admin.claims.tabs.participant')
            @endif
        </div>
        <div class="tab-pane fade @if($tab === 'debtor') show active @endif" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            @if($tab === 'debtor')
                @include('admin.claims.tabs.participant')
            @endif
        </div>
        <div class="tab-pane fade @if($tab === 'documents') show active @endif" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            @if($tab === 'documents')
                @include('admin.claims.tabs.documents')
            @endif
        </div>
{{--        <div class="tab-pane fade @if($tab === 'debtor') show active @endif" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">--}}
{{--            @if($tab === 'debtor')--}}
{{--                @include('admin.claims.tabs.participant')--}}
{{--            @endif--}}
{{--        </div>--}}
{{--        <div class="tab-pane fade @if($tab === 'debtor') show active @endif" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">--}}
{{--            @if($tab === 'debtor')--}}
{{--                @include('admin.claims.tabs.participant')--}}
{{--            @endif--}}
{{--        </div>--}}
    </div>
@endsection
