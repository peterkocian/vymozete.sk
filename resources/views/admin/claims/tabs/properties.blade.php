@php
    $columns = [
        [
            'label' => __('property.Title'),
            'key' => 'title',
            'type' => 'text'
        ],
        [
            'label' => __('property.Amount'),
            'key' => 'amountWithCurrency',
            'type' => 'number',
            'map' => 'amount'
        ],
        [
            'label' => __('property.Description'),
            'key' => 'description',
            'type' => 'text'
        ],
        [
            'label' => __('general.Created at'),
            'key' => 'created_at',
            'type' => 'date'
        ],
    ];

    $config = [
        'reloadUrl'     => "/admin/claims/{$claim_id}/properties",
        'showPagination' => \App\Models\Property::INDEX_VIEW_PAGINATION,
        'showPerPageSelect' => \App\Models\Property::INDEX_VIEW_PER_PAGE_SELECT,
        'itemsPerPage'  => \App\Helpers\SimpleTable::ITEMS_PER_PAGE,
        'numberOfRows'  => \App\Helpers\SimpleTable::NUMBER_OF_ROWS,
        'sortKey'       => \App\Helpers\SimpleTable::SORT_KEY,
        'sortDirection' => \App\Helpers\SimpleTable::SORT_DIRECTION,

        'inlineNew' => [
            'label' => 'add',
            'title' => __('general.Create'),
            'key' => 'store',
            'class' => 'btn btn-primary btn-sm mr-1',
            'action' => 'createItem',
            'url' => "/admin/claims/{$claim_id}/properties",
            'fields' => [
                [
                    'label' => __('property.Title'),
                    'key' => 'title',
                    'type' => 'text',
                    'settings' => [
                        'divClass' => 'col-2 pl-0',
                        'required' => true,
                        'searchable' => true
                    ]
                ],
                [
                    'label' => __('property.Amount'),
                    'key' => 'amount',
                    'type' => 'number',
                    'settings' => [
                        'divClass' => 'col-2',
                        'required' => true,
                        'searchable' => true
                    ]
                ],
                [
                    'label' => __('property.Currency'),
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
                    'label' => __('property.Description'),
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
            'label' => 'delete',
            'title' => __('general.Delete'),
            'key' => 'delete',
            'class' => 'btn btn-sm btn-outline-danger',
            'url' => url(config('simple-table.route-prefix')."/claims/{$claim_id}/properties/{id}"),
            'dataToggle' => 'modal',
            'dataTarget' => '#modalConfirm',
            'modalText' => __('general.Confirmation delete'),
            'requestMethod' => 'DELETE',
            'ajax' => true
        ]
    ];

    $gridview = new \App\Helpers\SimpleTable($columns, $data, \App\Models\Property::ENTITY_ROUTE_PREFIX, $config, $actions);
@endphp
<div class="row">
    <div class="col">
        <?= $gridview->render(); ?>
    </div>
</div>
