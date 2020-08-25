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
    ];

    $config['inlineNew'] = [
        'label' => __('general.Create'),
        'key' => 'store',
        'class' => 'btn btn-primary btn-sm mr-1',
        'action' => 'createItem',
        'url' => "/admin/claims/{$claim['id']}/notes",
        'fields' => [
            [
                'label' => __('note.Title'),
                'key' => 'title',
                'type' => 'text',
                'settings' => [
                    'required' => true,
                    'searchable' => true
                ]
            ],
            [
                'label' => __('note.Description'),
                'key' => 'description',
                'type' => 'textarea',
                'settings' => [
                    'required' => true,
                    'searchable' => true
                ]
            ],
        ]
    ];
    $config['hide-pagination'] = true;
    $config['hide-itemsPerPage'] = true;
    $config['reloadUrl'] = "/admin/claims/{$claim['id']}/notes";

    $actions = [
        [
            'label' => 'edit',
            'title' => __('general.Edit'),
            'key' => 'edit',
            'class' => 'btn btn-primary btn-sm mr-1',
            'url' => url(config('simple-table.route-prefix').'admin/notes/{id}/edit')
        ],
        [
            'label' => 'delete',
            'title' => __('general.Delete'),
            'key' => 'delete',
            'class' => 'btn btn-sm btn-danger',
            'url' => url(config('simple-table.route-prefix').'admin/notes/{id}'),
            'dataToggle' => 'modal',
            'dataTarget' => '#modalConfirm',
            'modalText' => __('general.Confirmation delete'),
            'ajax' => true
        ]
    ];

    $gridview = new \App\Helpers\SimpleTable($columns, $data, \App\Models\Note::ENTITY_ROUTE_PREFIX, $config, $actions);
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
