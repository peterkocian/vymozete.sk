@php
    $columns = [
        [
            'label' => __('claim.Claim ID'),
            'key' => 'id',
            'type' => 'number',
            'settings' => [
                'searchable' => true,
                'placeholder' => __('general.Search placeholder')
            ]
        ],
        [
            'label' => __('claim.Creditor'),
            'key' => 'creditorFullName',
            'type' => 'text',
            'map' => 'creditor_id',
            'settings' => [
                'searchable' => true,
                'placeholder' => __('general.Search placeholder')
            ]
        ],
        [
            'label' => __('claim.Debtor'),
            'key' => 'debtorFullName',
            'type' => 'text',
            'map' => 'debtor_id',
            'settings' => [
                'searchable' => true,
                'placeholder' => __('general.Search placeholder')
            ]
        ],
        [
            'label' => __('claim.Amount'),
            'key' => 'amountWithCurrency',
            'type' => 'text',
            'map' => 'amount',
            'settings' => [
                'searchable' => true,
                'placeholder' => __('general.Search placeholder')
            ]
        ],
        [
            'label' => __('claim.Status'),
            'key' => 'statusName',
            'type' => 'text',
            'map' => 'claim_status_id',
            'settings' => [
                'searchable' => true,
                'placeholder' => __('general.Search placeholder')
            ]
        ],
        [
            'label' => __('claim.Type'),
            'key' => 'typeName',
            'type' => 'text',
            'map' => 'claim_type_id',
            'settings' => [
                'searchable' => true,
                'placeholder' => __('general.Search placeholder')
            ]
        ],
        [
            'label' => __('general.Created at'),
            'key' => 'created_at',
            'type' => 'date',
            'settings' => [
                'searchable' => true,
                'placeholder' => __('general.Search placeholder')
            ]
        ],
    ];

    $config = [
        'reloadUrl'     => "/admin/claims",
        'showPagination' => \App\Models\Claim::INDEX_VIEW_PAGINATION,
        'showPerPageSelect' => \App\Models\Claim::INDEX_VIEW_PER_PAGE_SELECT,
        'itemsPerPage'  => \App\Helpers\SimpleTable::ITEMS_PER_PAGE,
        'numberOfRows'  => \App\Helpers\SimpleTable::NUMBER_OF_ROWS,
        'sortKey'       => \App\Helpers\SimpleTable::SORT_KEY,
        'sortDirection' => \App\Helpers\SimpleTable::SORT_DIRECTION,
        'searchable'    => true,
    ];

    $actions = [
        [
            'label' => 'visibility',
            'title' => __('general.Detail'),
            'key' => 'detail',
            'class' => 'btn btn-sm btn-outline-primary mr-1',
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
