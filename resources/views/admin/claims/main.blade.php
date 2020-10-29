@extends ('admin.layouts.app')
@section ('content')
    @include('admin.claims.tabs')
    <div class="tab-content">
        <div class="tab-pane fade @if($tab === 'overview') show active @endif" role="tabpanel" aria-labelledby="nav-home-tab">
            @if($tab === 'overview')
                @include('admin.claims.tabs.overview')
            @endif
        </div>
        <div class="tab-pane fade @if($tab === 'creditor') show active @endif" role="tabpanel" aria-labelledby="nav-profile-tab">
            @if($tab === 'creditor')
                @include('admin.claims.tabs.participant')
            @endif
        </div>
        <div class="tab-pane fade @if($tab === 'debtor') show active @endif" role="tabpanel" aria-labelledby="nav-contact-tab">
            @if($tab === 'debtor')
                @include('admin.claims.tabs.participant')
            @endif
        </div>
        <div class="tab-pane fade @if($tab === 'documents') show active @endif" role="tabpanel" aria-labelledby="nav-contact-tab">
            @if($tab === 'documents')
                @include('admin.claims.tabs.documents')
            @endif
        </div>
        <div class="tab-pane fade @if($tab === 'properties') show active @endif" role="tabpanel" aria-labelledby="nav-contact-tab">
            @if($tab === 'properties')
                @include('admin.claims.tabs.properties')
            @endif
        </div>
        <div class="tab-pane fade @if($tab === 'calculations') show active @endif" role="tabpanel" aria-labelledby="nav-contact-tab">
            @if($tab === 'calculations')
                @include('admin.claims.tabs.calculations')
            @endif
        </div>
        <div class="tab-pane fade @if($tab === 'notes') show active @endif" role="tabpanel" aria-labelledby="nav-contact-tab">
            @if($tab === 'notes')
                @include('admin.claims.tabs.notes')
            @endif
        </div>
        <div class="tab-pane fade @if($tab === 'calendar') show active @endif" role="tabpanel" aria-labelledby="nav-contact-tab">
            @if($tab === 'calendar')
                @include('admin.claims.tabs.calendar')
            @endif
        </div>
    </div>
@endsection
