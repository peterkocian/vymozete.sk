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
            'type' => 'text',
            'map' => 'creditor_id'
        ],
        [
            'label' => __('claim.Debtor'),
            'key' => 'debtorPlain',
            'type' => 'text',
            'map' => 'debtor_id'
        ],
        [
            'label' => __('claim.Amount'),
            'key' => 'amountWithCurrency',
            'type' => 'text',
            'map' => 'amount'
        ],
        [
            'label' => __('claim.Status'),
            'key' => 'statusPlain',
            'type' => 'text',
            'map' => 'claim_status_id'
        ],
        [
            'label' => __('claim.Type'),
            'key' => 'typePlain',
            'type' => 'text',
            'map' => 'claim_type_id'
        ],
        [
            'label' => __('general.Created at'),
            'key' => 'created_at',
            'type' => 'date'
        ],
    ];

    $config = [
        'reloadUrl'     => "/admin/claims",
        'showPagination' => \App\Models\Claim::INDEX_VIEW_PAGINATION,
        'itemsPerPage'  => \App\Helpers\SimpleTable::ITEMS_PER_PAGE,
        'numberOfRows'  => \App\Helpers\SimpleTable::NUMBER_OF_ROWS,
        'sortKey'       => 'created_at',
        'sortDirection' => 'asc',
    ];

    $actions = [
        [
            'label' => 'visibility',
            'title' => __('general.Detail'),
            'key' => 'detail',
            'class' => 'btn btn-primary btn-sm mr-1',
            'url' => url(config('simple-table.route-prefix').'/'.\App\Models\Claim::ENTITY_ROUTE_PREFIX.'/{id}/overview')
        ],
    ];

    $gridview = new \App\Helpers\SimpleTable($columns, $data, \App\Models\Claim::ENTITY_ROUTE_PREFIX, $config, $actions);
@endphp
@extends ('admin.layouts.app')
@section ('content')
    <div class="card">
        <div class="card-header">{{__('claim.Claim list')}}</div>
        <div class="card-body">
            <?= $gridview->render(); ?>
        </div>
    </div>
@endsection
