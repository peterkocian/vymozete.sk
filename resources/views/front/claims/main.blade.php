@extends('front.layout')

@section('content')
    <div class="mainbox mainbox_white">
        <div class="row"><h1>Detail pohľadávky</h1></div>
        @include('front.claims.tabs')
        <div class="row">
            <div class="tab-content">
                <div class="tab-pane fade @if($tab === 'overview') show active @endif" role="tabpanel" aria-labelledby="nav-home-tab">
                    @if($tab === 'overview')
                        @include('front.claims.tabs.overview')
                    @endif
                </div>
                <div class="tab-pane fade @if($tab === 'debtor') show active @endif" role="tabpanel" aria-labelledby="nav-contact-tab">
                    @if($tab === 'debtor')
                        @include('front.claims.tabs.participant')
                    @endif
                </div>
                <div class="tab-pane fade @if($tab === 'creditor') show active @endif" role="tabpanel" aria-labelledby="nav-profile-tab">
                    @if($tab === 'creditor')
                        @include('front.claims.tabs.participant')
                    @endif
                </div>
                <div class="tab-pane fade @if($tab === 'documents') show active @endif" role="tabpanel" aria-labelledby="nav-contact-tab">
                    @if($tab === 'documents')
                        @include('front.claims.tabs.documents')
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
