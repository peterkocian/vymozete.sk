@php
    $columns = [
        [
            'label' => __('claim.Creditor'),
            'key' => 'creditor_id',
            'type' => 'text'
        ],
        [
            'label' => __('claim.Debtor'),
            'key' => 'debtor_id',
            'type' => 'text',
        ],
        [
            'label' => __('claim.Amount'),
            'key' => 'amount',
            'type' => 'text'
        ],
        [
            'label' => __('claim.Status'),
            'key' => 'claim_status_id',
            'type' => 'text'
        ],
        [
            'label' => __('general.Created at'),
            'key' => 'created_at',
            'type' => 'date'
        ],
    ];

    $gridview = new \App\Helpers\SimpleTable($columns, $data, \App\Models\Claim::ENTITY_ROUTE_PREFIX, []);
@endphp
@extends ('admin.layouts.app')
@section ('content')
    <div class="card">
        <div class="card-header">{{__('claim.Claim list')}}</div>
        <div class="card-body">
{{--            <div class="form-group form-row">--}}
{{--                <a role="button" class="btn btn-primary btn-sm" href="{{ route('admin.claims.create') }}">{{__('general.Create')}}</a>--}}
{{--            </div>--}}
            <?= $gridview->render(); ?>
        </div>
    </div>
@endsection
