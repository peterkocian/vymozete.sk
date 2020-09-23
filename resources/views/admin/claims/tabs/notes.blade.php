@php
    $columns = [
        [
            'label' => __('note.Title'),
            'key' => 'title',
            'type' => 'text'
        ],
        [
            'label' => __('note.Description'),
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
        'reloadUrl'     => "/admin/claims/{$claim_id}/notes",
        'showPagination' => \App\Models\Note::INDEX_VIEW_PAGINATION,
        'showPerPageSelect' => \App\Models\Note::INDEX_VIEW_PER_PAGE_SELECT,
        'itemsPerPage'  => \App\Helpers\SimpleTable::ITEMS_PER_PAGE,
        'numberOfRows'  => \App\Helpers\SimpleTable::NUMBER_OF_ROWS,
        'sortKey'       => \App\Helpers\SimpleTable::SORT_KEY,
        'sortDirection' => \App\Helpers\SimpleTable::SORT_DIRECTION,

        'inlineNew' => [
            'label' => __('general.Create'),
            'key' => 'store',
            'class' => 'btn btn-sm btn-outline-primary mr-1',
            'action' => 'createItem',
            'url' => "/admin/claims/{$claim_id}/notes",
            'fields' => [
                [
                    'label' => __('note.Title'),
                    'key' => 'title',
                    'type' => 'text',
                    'settings' => [
                        'divClass' => 'col-3  pl-0',
                        'required' => true,
                        'searchable' => true
                    ]
                ],
                [
                    'label' => __('note.Description'),
                    'key' => 'description',
                    'type' => 'textarea',
                    'settings' => [
                        'divClass' => 'col-6',
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
            'url' => url(config('simple-table.route-prefix')."/claims/{$claim_id}/notes/{id}/edit")
        ],
        [
            'label' => 'delete',
            'title' => __('general.Delete'),
            'key' => 'delete',
            'class' => 'btn btn-sm btn-outline-danger',
            'url' => url(config('simple-table.route-prefix')."/claims/{$claim_id}/notes/{id}"),
            'dataToggle' => 'modal',
            'dataTarget' => '#modalConfirm',
            'modalText' => __('general.Confirmation delete'),
            'requestMethod' => 'DELETE',
            'ajax' => true
        ]
    ];

    $gridview = new \App\Helpers\SimpleTable($columns, $data, \App\Models\Note::ENTITY_ROUTE_PREFIX, $config, $actions);
@endphp
<div class="card">
    <div class="card-body">
        <?= $gridview->render(); ?>
    </div>
</div>
