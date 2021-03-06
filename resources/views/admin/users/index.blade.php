@php
    $columns = [
        [
            'label' => __('user.Name'),
            'key' => 'name',
            'type' => 'text',
            'settings' => [
                'searchable' => true,
                'placeholder' => __('general.Search placeholder')
            ]
        ],
        [
            'label' => __('user.Surname'),
            'key' => 'surname',
            'type' => 'text',
            'settings' => [
                'searchable' => true,
                'placeholder' => __('general.Search placeholder')
            ]
        ],
        [
            'label' => __('user.Email'),
            'key' => 'email',
            'type' => 'text',
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
        'reloadUrl'     => "/admin/users",
        'showPagination' => \App\Models\User::INDEX_VIEW_PAGINATION,
        'showPerPageSelect' => \App\Models\User::INDEX_VIEW_PER_PAGE_SELECT,
        'itemsPerPage'  => \App\Helpers\SimpleTable::ITEMS_PER_PAGE,
        'numberOfRows'  => \App\Helpers\SimpleTable::NUMBER_OF_ROWS,
        'sortKey'       => \App\Helpers\SimpleTable::SORT_KEY,
        'sortDirection' => \App\Helpers\SimpleTable::SORT_DIRECTION,
        'searchable'    => true,
    ];

    $actions = [
        [
            'label' => 'block',
            'title' => __('general.Ban'),
            'key' => 'ban',
            'class' => 'btn btn-sm btn-outline-danger mr-1 ml-1',
            'url' => url(config('simple-table.route-prefix').'/'.\App\Models\User::ENTITY_ROUTE_PREFIX.'/{id}/ban'),
            'dataToggle' => 'modal',
            'dataTarget' => '#modalConfirm',
            'modalText' => __('general.Ban user'),
            'requestMethod' => 'POST',
            'ajax' => true
        ],
        [
            'label' => 'refresh',
            'title' => __('general.Unban'),
            'key' => 'unban',
            'class' => 'btn btn-sm btn-outline-success mr-1',
            'url' => url(config('simple-table.route-prefix').'/'.\App\Models\User::ENTITY_ROUTE_PREFIX.'/{id}/unban'),
            'dataToggle' => 'modal',
            'modalText' => __('general.Unban user'),
            'dataTarget' => '#modalConfirm',
            'requestMethod' => 'POST',
            'ajax' => true
        ],
        [
            'label' => 'email',
            'title' => __('general.Reset password'),
            'key' => 'passwordReset',
            'class' => 'btn btn-sm btn-outline-primary',
            'url' => url('password/email'),
            'dataToggle' => 'modal',
            'dataTarget' => '#modalConfirm',
            'modalText' => __('general.Reset user password'),
            'requestMethod' => 'POST',
            'ajax' => true
        ]
    ];

    $gridview = new \App\Helpers\SimpleTable($columns, $data, \App\Models\User::ENTITY_ROUTE_PREFIX, $config, $actions, true);
@endphp
@extends ('admin.layouts.app')
@section ('content')
    <div class="card">
        <div class="card-header">{{__('user.User list')}}</div>
        <div class="card-body">
            <div class="form-group form-row">
                <a role="button" title="@lang('general.Create')" class="btn btn-primary btn-sm" href="{{ route('admin.users.create') }}"><span class="material-icons">add</span></a>
            </div>
            <?= $gridview->render(); ?>
        </div>
    </div>
@endsection
