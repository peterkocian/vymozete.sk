@extends('front.layout')

@section('content')
    <div class="mainbox mainbox_white">
        <div class="row"><h1>@lang('front/main.My claims')</h1></div>
        <div class="row"><p>
            <a href="{{ route('front.claim') }}"><b>@lang('front/main.Add new claim')</b></a>
            &nbsp;/ <a href="{{ route('front.users.editProfile', Auth::id()) }}"><b>@lang('front/main.Edit user profile')</b></a></p>
        </div>

        <div class="row table-pohladavka">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('front/main.created_at')</th>
                        <th>@lang('front/main.creditor')</th>
                        <th>@lang('front/main.debtor')</th>
                        <th>@lang('front/main.amount')</th>
                        <th>@lang('front/main.status')</th>
                        <th>@lang('front/main.actions')</th>
                    </tr>
                </thead>
                <tbody>
                @php($i = 1)
                @forelse($claims as $claim)
                    <tr class="hover">
                        <td>{{ $i++ }}</td>
                        <td>{{ $claim->created_at }}</td>
                        <td>{{ $claim->creditor->entity_type === \App\Models\Person::class ? $claim->creditor->entity->fullName : $claim->creditor->entity->name  }}</td>
                        <td>{{ $claim->debtor->entity_type === \App\Models\Person::class ? $claim->debtor->entity->fullName : $claim->debtor->entity->name  }}</td>
                        <td>{{ $claim->amount }}</td>
                        <td>{{ $claim->claimStatus->name }}</td>
                        <td><a href="{{ route('front.claims.overview', $claim->id) }}">Detail</a></td>
                    </tr>
                @empty
                    <tr class="no-content">
                        <td colspan="7">
                            <div class="notice">@lang('front/main.no claims created')</div>
                            <div>
                                <a class="big_btn" href="{{ route('front.claim') }}">@lang('front/main.create')</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
