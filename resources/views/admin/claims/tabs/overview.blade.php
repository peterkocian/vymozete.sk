@php
    $columns = [
        [
            'label' => __('file.Filename'),
            'key' => 'name',
            'type' => 'text'
        ],
        [
            'label' => __('general.Created at'),
            'key' => 'created_at',
            'type' => 'date'
        ],
    ];

    $config = [
        'reloadUrl' => "/admin/claims/{$claim_id}/documents?fromPage=overview",
        'showPagination' => \App\Models\File::OVERVIEW_VIEW_PAGINATION,
        'showPerPageSelect' => \App\Models\File::OVERVIEW_VIEW_PER_PAGE_SELECT,
        'itemsPerPage'  => \App\Helpers\SimpleTable::ITEMS_PER_PAGE,
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
        ]
    ];

    $gridview = new \App\Helpers\SimpleTable($columns, $files, \App\Models\File::ENTITY_ROUTE_PREFIX, $config, $actions);
@endphp

<div class="row">
    <div class="col col-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                Všeobecné informácie
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="amount" class="col-12 col-sm-3 col-form-label">{{__('claim.Amount')}}</label>
                    <div class="col-12 col-sm-9">
                        <input class="form-control" type="text" name="amount"  value="{{ $claim->amountWithCurrency }}" disabled/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="claim_type" class="col-12 col-sm-3 col-form-label">{{__('claim.Type')}}</label>
                    <div class="col-12 col-sm-9">
                        <input class="form-control" type="text" name="claim_type" value="{{ $claim->type_name }}" disabled/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="claim_status" class="col-12 col-sm-3 col-form-label">{{__('claim.Status')}}</label>
                    <div class="col-12 col-sm-9">
                        <input class="form-control" type="text" name="claim_status" value="{{ $claim->status_name }}" disabled/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="created_at" class="col-12 col-sm-3 col-form-label">{{__('general.Created at')}}</label>
                    <div class="col-12 col-sm-9">
                        <input class="form-control" type="text" name="created_at" value="{{ $claim->created_at }}" disabled/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="updated_at" class="col-12 col-sm-3 col-form-label">{{__('general.Updated at')}}</label>
                    <div class="col-12 col-sm-9">
                        <input class="form-control" type="text" name="updated_at" value="{{ $claim->updated_at }}" disabled/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col col-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                @lang('claim.Documents')
            </div>
            <div class="card-body">
                <?= $gridview->render(); ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col col-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                @lang('claim.Creditor')
            </div>
            <div class="card-body">
                @include('admin.claims.tabs.participant', ['data' => $creditor, 'title' => __('claim.Creditor')])
            </div>
        </div>
    </div>

    <div class="col col-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                @lang('claim.Debtor')
            </div>
            <div class="card-body">
                @include('admin.claims.tabs.participant', ['data' => $debtor, 'title' => __('claim.Debtor')])
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col col-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-12 col-sm-3 col-form-label">{{__('claim.Amount')}}</label>
                    <div class="col-12 col-sm-9">
                        <input class="form-control" type="text" name="name"  value="{{ $claim->amountWithCurrency }}" disabled/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="surname" class="col-12 col-sm-3 col-form-label">{{__('claim.Debtor')}}</label>
                    <div class="col-12 col-sm-9">
                        <input class="form-control" type="text" name="surname" value="{{ $claim->debtor->entity->fullname }}" disabled/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-12 col-sm-3 col-form-label">{{__('claim.Creditor')}}</label>
                    <div class="col-12 col-sm-9">
                        <input class="form-control" type="text" name="email" value="{{ $claim->creditor->entity->fullname }}" disabled/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="created_at" class="col-12 col-sm-3 col-form-label">{{__('general.Created at')}}</label>
                    <div class="col-12 col-sm-9">
                        <input class="form-control" type="text" name="created_at" value="{{ $claim->created_at }}" disabled/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="updated_at" class="col-12 col-sm-3 col-form-label">{{__('general.Updated at')}}</label>
                    <div class="col-12 col-sm-9">
                        <input class="form-control" type="text" name="updated_at" value="{{ $claim->updated_at }}" disabled/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
