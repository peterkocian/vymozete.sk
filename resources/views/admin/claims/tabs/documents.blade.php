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
            'key' => 'file_type_id',
            'type' => 'text'
        ],
        [
            'label' => __('general.Created at'),
            'key' => 'created_at',
            'type' => 'date'
        ],
    ];

    $config['inlineNew'] = [
        'label' => __('general.Create'),
        'key' => 'store',
        'class' => 'btn btn-primary btn-sm mr-1',
        'action' => 'createItem',
        'url' => '/admin/claims/'.$claim['id'].'/documents/upload-files',
        'fields' => [
            [
                'label' => __('file.Filename'),
                'key' => 'filename',
                'type' => 'text',
                'settings' => [
                    'required' => true,
                    'searchable' => true
                ]
            ],
            [
                'label' => __('file.File type'),
                'key' => 'file_type_id',
                'type' => 'select',
                'settings' => [
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
                    'required' => true,
                    'searchable' => true
                ]
            ],
            [
                'label' => __('file.File'),
                'key' => 'file',
                'type' => 'file',
                'settings' => [
                    'required' => true,
                    'searchable' => true
                ]
            ],
        ]
    ];
    $config['hide-pagination'] = true;
    $config['hide-itemsPerPage'] = true;

    $actions = [
        [
            'label' => '<img src="'.asset('/images/simple-table/visibility-white-18dp.svg').'"/>',
            'title' => __('general.Download'),
            'key' => 'download',
            'class' => 'btn btn-primary btn-sm mr-1',
            'url' => url(config('simple-table.route-prefix').'admin/download/{id}')
        ],
        [
            'label' => '<img src="'.asset('/images/simple-table/delete-white-18dp.svg').'"/>',
            'title' => __('general.Delete'),
            'key' => 'delete',
            'class' => 'btn btn-sm btn-danger',
            'url' => url(config('simple-table.route-prefix').'admin/delete/{id}'),
            'dataToggle' => 'modal',
            'dataTarget' => '#modalConfirm',
            'modalText' => __('general.Confirmation delete')
        ]
    ];

    $gridview = new \App\Helpers\SimpleTable($columns, $data, \App\Models\File::ENTITY_ROUTE_PREFIX, $config, $actions);
@endphp
<div class="card">
{{--    <div class="card-header">{{__('user.User list')}}</div>--}}
    <div class="card-body">
        <?= $gridview->render(); ?>
    </div>
</div>

{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">Add files</div>--}}

{{--                <div class="card-body">--}}
{{--                    <upload-component :input_name="'files[]'" :post_url="'documents/upload-file'"></upload-component>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
