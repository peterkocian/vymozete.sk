@php
    $columns = [
        [
            'label' => __('file.Filename'),
            'key' => 'name',
            'type' => 'text'
        ],
        [
            'label' => __('file.Size'),
            'key' => 'size',
            'type' => 'number',
        ],
        [
            'label' => __('file.File type'),
            'key' => 'fileTypeName',
            'type' => 'text',
            'map' => 'file_type_id'
        ],
        [
            'label' => __('file.Show to customer'),
            'key' => 'showToCustomerName',
            'type' => 'text',
            'map' => 'show_to_customer',

        ],
        [
            'label' => __('general.Created at'),
            'key' => 'created_at',
            'type' => 'date'
        ],
    ];

    $config = [
        'inlineNew' => [
            'label' => __('general.Create'),
            'key' => 'store',
            'class' => 'btn btn-primary btn-sm mr-1',
            'action' => 'uploadFile',
            'url' => "/admin/claims/{$claim_id}/documents/upload-files",
            'fields' => [
                [
                    'label' => __('file.Filename'),
                    'key' => 'filename',
                    'type' => 'text',
                    'settings' => [
                        'divClass' => 'col-sm-2 pl-0',
                        'required' => true,
                        'searchable' => true
                    ]
                ],
                [
                    'label' => __('file.File type'),
                    'key' => 'file_type_id',
                    'type' => 'select',
                    'settings' => [
                        'divClass' => '',
                        'required' => true,
                        'searchable' => true
                    ],
                    'options' => $fileTypes
                ],
                [
                    'label' => __('file.Show to customer'),
                    'key' => 'show_to_customer',
                    'type' => 'checkbox',
                    'settings' => [
                        'divClass' => 'col-sm-3',
                        'required' => true,
                        'searchable' => true
                    ]
                ],
                [
                    'label' => __('file.File'),
                    'key' => 'uploads',
                    'type' => 'file',
                    'settings' => [
                        'divClass' => 'col-sm-3',
                        'required' => true,
                        'searchable' => true
                    ]
                ]
            ]
        ],
        'reloadUrl' => "/admin/claims/{$claim_id}/documents",
        'showPagination' => \App\Models\File::INDEX_VIEW_PAGINATION,
        'showPerPageSelect' => \App\Models\File::INDEX_VIEW_PER_PAGE_SELECT,
        //'itemsPerPage'  => \App\Helpers\SimpleTable::ITEMS_PER_PAGE,
        'itemsPerPage'  => [1,2,3],
        'numberOfRows'  => \App\Helpers\SimpleTable::NUMBER_OF_ROWS,
        'sortKey'       => \App\Helpers\SimpleTable::SORT_KEY,
        'sortDirection' => \App\Helpers\SimpleTable::SORT_DIRECTION,
    ];

    $actions = [
        [
            'label' => 'get_app',
            'title' => __('general.Download'),
            'key' => 'download',
            'class' => 'btn btn-sm btn-outline-primary mr-1',
            'url' => url(config('simple-table.route-prefix').'/file/{id}/download')
        ],
        [
            'label' => 'delete',
            'title' => __('general.Delete'),
            'key' => 'delete',
            'class' => 'btn btn-sm btn-outline-danger',
            'url' => url(config('simple-table.route-prefix')."/file/{id}/delete"),
            'dataToggle' => 'modal',
            'dataTarget' => '#modalConfirm',
            'modalText' => __('general.Confirmation delete'),
            'requestMethod' => 'DELETE',
            'ajax' => true
        ]
    ];

    $gridview = new \App\Helpers\SimpleTable($columns, $data, \App\Models\File::ENTITY_ROUTE_PREFIX, $config, $actions);
@endphp
<div class="card">
    <div class="card-body">
        <?= $gridview->render(); ?>
    </div>
</div>
