@extends('front.layout')

@section('content')
    <div class="mainbox mainbox_white">

        <div class="row"><h1>Moje pohľadávky</h1></div>
        <div class="row"><p>
            <a href="{{ route('front.claim') }}"><b>Pridať novú pohľadávku</b></a>
            &nbsp;/ <a href="{{ route('front.users.editProfile', Auth::id()) }}"><b>Upraviť moje údaje</b></a></p>
        </div>

        <div class="row"><h4>Všetky Vaše pohľadávky</h4></div>

        <div class="row table-pohladavka">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>vytvorené</th>
                        <th>veriteľ</th>
                        <th>dlžník</th>
                        <th>dlžná suma</th>
                        <th>stav</th>
                        <th>akcie</th>
                    </tr>
                </thead>
                <tbody>
                @php($i = 1)
                @forelse($claims as $claim)
                    <tr class="hover">
                        <td>{{ $i++ }}</td>
                        <td>{{ $claim->created_at }}</td>
                        <td>{{ $claim->creditor->entity_type === 'App\Models\Front\Person' ? $claim->creditor->entity->fullName : $claim->creditor->entity->name  }}</td>
                        <td>{{ $claim->debtor->entity_type === 'App\Models\Front\Person' ? $claim->debtor->entity->fullName : $claim->debtor->entity->name  }}</td>
                        <td>{{ $claim->amount }}</td>
                        <td>{{ $claim->claimStatus->name }}</td>
                        <td>Detail</td>
                    </tr>
                @empty
                    <tr class="no-content">
                        <td colspan="7">
                            <div class="notice">nemáte vytvorenú žiadnu pohľadávku</div>
                            <div>
                                <a class="big_btn" href="{{ route('front.claim') }}">vytvoriť</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
