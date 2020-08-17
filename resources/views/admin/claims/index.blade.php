@php
    $columns = [
        [
            'label' => __('claim.Claim ID'),
            'key' => 'id',
            'type' => 'number'
        ],
        [
            'label' => __('claim.Creditor'),
            'key' => 'creditorPlain',
            'type' => 'text'
        ],
        [
            'label' => __('claim.Debtor'),
            'key' => 'debtorPlain',
            'type' => 'text',
        ],
        [
            'label' => __('claim.Amount'),
            'key' => 'amountWithCurrency',
            'type' => 'text'
        ],
        [
            'label' => __('claim.Status'),
            'key' => 'statusPlain',
            'type' => 'text'
        ],
        [
            'label' => __('claim.Type'),
            'key' => 'typePlain',
            'type' => 'text'
        ],
        [
            'label' => __('general.Created at'),
            'key' => 'created_at',
            'type' => 'date'
        ],
    ];

    $actions = [
        [
            'label' => '<img src="'.asset('/images/simple-table/visibility-white-18dp.svg').'"/>',
            'title' => __('general.Detail'),
            'key' => 'detail',
            'class' => 'btn btn-primary btn-sm mr-1',
            'url' => url(config('simple-table.route-prefix').\App\Models\Claim::ENTITY_ROUTE_PREFIX.'{id}/overview')
        ],
    ];

    $gridview = new \App\Helpers\SimpleTable($columns, $data, \App\Models\Claim::ENTITY_ROUTE_PREFIX, [], $actions);
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
