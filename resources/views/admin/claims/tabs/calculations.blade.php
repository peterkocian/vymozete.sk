@php
    $columns = [
        [
            'label' => __('calculation.Date'),
            'key' => 'date',
            'type' => 'date'
        ],
        [
            'label' => __('calculation.Amount'),
            'key' => 'amountWithCurrency',
            'type' => 'text',
            'map' => 'amount'
        ],
        [
            'label' => __('calculation.Description'),
            'key' => 'description',
            'type' => 'text'
        ],
        [
            'label' => __('calculation.Paid'),
            'key' => 'paidLabel',
            'type' => 'checkbox',
            'map' => 'paid',
        ],
        [
            'label' => __('general.Created at'),
            'key' => 'created_at',
            'type' => 'date'
        ],
    ];

    $config = [
        'reloadUrl'     => "/admin/claims/{$claim_id}/calculations",
        'showPagination' => \App\Models\Calculation::INDEX_VIEW_PAGINATION,
        'showPerPageSelect' => \App\Models\Calculation::INDEX_VIEW_PER_PAGE_SELECT,
        'itemsPerPage'  => \App\Helpers\SimpleTable::ITEMS_PER_PAGE,
        'numberOfRows'  => \App\Helpers\SimpleTable::NUMBER_OF_ROWS,
        'sortKey'       => \App\Helpers\SimpleTable::SORT_KEY,
        'sortDirection' => \App\Helpers\SimpleTable::SORT_DIRECTION,

        'inlineNew' => [
            'label' => __('general.Create'),
            'key' => 'store',
            'class' => 'btn btn-sm btn-outline-primary mr-1',
            'action' => 'createItem',
            'url' => "/admin/claims/{$claim_id}/calculations",
            'fields' => [
                [
                    'label' => __('calculation.Date'),
                    'key' => 'date',
                    'type' => 'date',
                    'settings' => [
                        'divClass' => 'col-2  pl-0',
                        'required' => true,
                        'searchable' => true
                    ]
                ],
                [
                    'label' => __('calculation.Amount'),
                    'key' => 'amount',
                    'type' => 'number',
                    'settings' => [
                        'divClass' => 'col-2 pl-0',
                        'required' => true,
                        'searchable' => true
                    ]
                ],
                [
                    'label' => __('calculation.Currency'),
                    'key' => 'currency_id',
                    'type' => 'select',
                    'settings' => [
                        'divClass' => '',
                        'required' => true,
                        'searchable' => true
                    ],
                    'options' => $currencies
                ],
                [
                    'label' => __('calculation.Paid'),
                    'key' => 'paid',
                    'type' => 'checkbox',
                    'settings' => [
                        'divClass' => 'col-sm-2',
                        'required' => true,
                        'searchable' => true
                    ]
                ],
                [
                    'label' => __('calculation.Description'),
                    'key' => 'description',
                    'type' => 'textarea',
                    'settings' => [
                        'divClass' => 'col-4',
                        'required' => true,
                        'searchable' => true
                    ]
                ],
            ],
        ]
    ];

    $actions = [
        [
            'label' => 'edit',
            'title' => __('general.Edit'),
            'key' => 'edit',
            'class' => 'btn btn-sm btn-outline-primary mr-1',
            'url' => url(config('simple-table.route-prefix')."/claims/{$claim_id}/calculations/{id}/edit")
        ],
        [
            'label' => 'delete',
            'title' => __('general.Delete'),
            'key' => 'delete',
            'class' => 'btn btn-sm btn-outline-danger',
            'url' => url(config('simple-table.route-prefix')."/claims/{$claim_id}/calculations/{id}"),
            'dataToggle' => 'modal',
            'dataTarget' => '#modalConfirm',
            'modalText' => __('general.Confirmation delete'),
            'requestMethod' => 'DELETE',
            'ajax' => true
        ]
    ];

    $gridview = new \App\Helpers\SimpleTable($columns, $data, \App\Models\Calculation::ENTITY_ROUTE_PREFIX, $config, $actions);
@endphp
<div class="card">
    <div class="card-body">
        <?= $gridview->render(); ?>
    </div>
</div>
