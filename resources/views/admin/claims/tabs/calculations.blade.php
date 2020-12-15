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
            'label' => 'add',
            'title' => __('general.Create'),
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
                        'divClass' => 'col col-6 col-sm-2 pl-0',
                        'required' => true,
                        'searchable' => true
                    ]
                ],
                [
                    'label' => __('calculation.Amount'),
                    'key' => 'amount',
                    'type' => 'number',
                    'settings' => [
                        'divClass' => 'col col-6 col-sm-2 pl-0',
                        'required' => true,
                        'searchable' => true
                    ]
                ],
                [
                    'label' => __('calculation.Currency'),
                    'key' => 'currency_id',
                    'type' => 'select',
                    'settings' => [
                        'divClass' => 'col pl-0',
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
                        'divClass' => 'col col-6 col-sm-2 pl-0',
                        'required' => true,
                        'searchable' => true
                    ]
                ],
                [
                    'label' => __('calculation.Description'),
                    'key' => 'description',
                    'type' => 'textarea',
                    'settings' => [
                        'divClass' => 'col col-12 col-sm-4 pl-0',
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
            'url' => url(config('simple-table.route-prefix')."/".\App\Models\Calculation::ENTITY_ROUTE_PREFIX."/{$claim_id}/calculations/{id}/edit") //todo string claims replacnut konstantou z modelu
        ],
        [
            'label' => 'delete',
            'title' => __('general.Delete'),
            'key' => 'delete',
            'class' => 'btn btn-sm btn-outline-danger',
            'url' => url(config('simple-table.route-prefix')."/".\App\Models\Calculation::ENTITY_ROUTE_PREFIX."/{$claim_id}/calculations/{id}"),// todo @lang
            'dataToggle' => 'modal',
            'dataTarget' => '#modalConfirm',
            'modalText' => __('general.Confirmation delete'),
            'requestMethod' => 'DELETE',
            'ajax' => true
        ]
    ];

    $gridview = new \App\Helpers\SimpleTable($columns, $data, \App\Models\Calculation::ENTITY_ROUTE_PREFIX, $config, $actions);
@endphp
<div class="row">
    <div class="col">
        <?= $gridview->render(); ?>
    </div>
</div>

<div class="row">
    <div class="col col-12 col-sm-6">
        <div class="card">
            <div class="card-header">
                Výpočet
            </div>
            <div class="card-body">
                <div class="form-group-row">
                    <label for="due_date" class="col-12 col-form-label">{{__('calculation.Due date')}}</label>
                    <div class="col-12">
                        <input class="form-control" type="text" name="due_date" value="{{$payment_due_date}}" disabled/>
                    </div>
                </div>
                <div class="form-group-row">
                    <label for="istina" class="col-12 col-form-label">{{__('calculation.Istina')}}</label>
                    <div class="col-12">
                        <input class="form-control" type="text" name="istina" value="{{$amount_with_currency}}" disabled/>
                    </div>
                </div>
                <div class="form-group-row">
                    <label for="trovy" class="col-12 col-form-label">{{__('calculation.Trovy')}}</label>
                    <div class="col-12">
                        <input class="form-control" type="text" name="trovy" value="{{$trovy}}" disabled/>
                    </div>
                </div>
                <div class="form-group-row">
                    <label for="trovy_s_dph" class="col-12 col-form-label">{{__('calculation.Trovy s DPH')}}</label>
                    <div class="col-12">
                        <input class="form-control" type="text" name="trovy_s_dph" value="{{$trovyDPH}}" disabled/>
                    </div>
                </div>
                <div class="form-group-row">
                    <label for="urok" class="col-12 col-form-label">{{__('calculation.Urok')}}</label>
                    <div class="col-12">
                        <input class="form-control" type="text" name="urok" value="{{$urok}}" disabled/>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <small class="text-muted">{{__('calculation.Summary')}} {{ $summary }}</small>
            </div>
            <div class="card-body">
                <div class="form-group-row">
                    <label for="vymozene" class="col-12 col-form-label">{{__('calculation.Vymozene')}}</label>
                    <div class="col-12">
                        <input class="form-control" type="text" name="vymozene" value="{{$vymozene}}" disabled/>
                    </div>
                </div>
                <div class="form-group-row">
                    <label for="provizia" class="col-12 col-form-label">{{__('calculation.Provizia')}}</label>
                    <div class="col-12">
                        <input class="form-control" type="text" name="provizia" value="{{$provizia}}" disabled/>
                    </div>
                </div>
                <div class="form-group-row">
                    <label for="clientCashBack" class="col-12 col-form-label">{{__('calculation.Vratit klientovi')}}</label>
                    <div class="col-12">
                        <input class="form-control" type="text" name="clientCashBack" value="{{ $clientCashBack }}" disabled/>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <small class="text-muted">{{__('calculation.Vymoct')}} {{ $vymoct }}</small>
            </div>
        </div>
    </div>
</div>
