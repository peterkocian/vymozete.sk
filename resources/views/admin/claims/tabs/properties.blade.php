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
        ],
        [
            'label' => __('property.Description'),
            'key' => 'description',
            'type' => 'text'
        ],
    ];

    $config['inlineNew'] = [
        'label' => __('general.Create'),
        'key' => 'store',
        'class' => 'btn btn-primary btn-sm mr-1',
        'action' => 'createItem',
        'url' => "/admin/claims/{$claim['id']}/properties",
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
                    'divClass' => 'col-1',
                    'required' => true,
                    'searchable' => true
                ]
            ],
            [
                'label' => __('property.Currency'),
                'key' => 'currency_id',
                'type' => 'select',
                'settings' => [
                    'divClass' => 'col-1',
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
        ]
    ];
    $config['hide-pagination'] = true;
    $config['hide-itemsPerPage'] = true;
    $config['reloadUrl'] = "/admin/claims/{$claim['id']}/properties";

    $actions = [
        [
            'label' => 'delete',
            'title' => __('general.Delete'),
            'key' => 'delete',
            'class' => 'btn btn-sm btn-danger',
            'url' => url(config('simple-table.route-prefix').'/delete/{id}'),
            'dataToggle' => 'modal',
            'dataTarget' => '#modalConfirm',
            'modalText' => __('general.Confirmation delete')
        ]
    ];

    $gridview = new \App\Helpers\SimpleTable($columns, $data, \App\Models\Property::ENTITY_ROUTE_PREFIX, $config, $actions);
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
