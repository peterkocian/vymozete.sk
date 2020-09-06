@php
    $columns = [
        [
            'label' => __('user.Name'),
            'key' => 'name',
            'type' => 'text'
        ],
        [
            'label' => __('user.Surname'),
            'key' => 'surname',
            'type' => 'text',
        ],
        [
            'label' => __('user.Email'),
            'key' => 'email',
            'type' => 'text'
        ],
        [
            'label' => __('general.Created at'),
            'key' => 'created_at',
            'type' => 'date'
        ],
    ];

    $config = [
        'reloadUrl'     => "/admin/users",
        'showPagination' => \App\User::INDEX_VIEW_PAGINATION,
        'itemsPerPage'  => \App\Helpers\SimpleTable::ITEMS_PER_PAGE,
        'numberOfRows'  => \App\Helpers\SimpleTable::NUMBER_OF_ROWS,
        'sortKey'       => 'created_at',
        'sortDirection' => 'asc',
    ];

    $actions = [
        [
            'label' => 'visibility',
            'title' => __('general.Detail'),
            'key' => 'detail',
            'class' => 'btn btn-primary btn-sm mr-1',
            'url' => url(config('simple-table.route-prefix').'/'.\App\User::ENTITY_ROUTE_PREFIX.'/{id}')
        ],
        [
            'label' => 'edit',
            'title' => __('general.Edit'),
            'key' => 'edit',
            'class' => 'btn btn-primary btn-sm mr-1',
            'url' => url(config('simple-table.route-prefix').'/'.\App\User::ENTITY_ROUTE_PREFIX.'/{id}/edit')
        ],
        [
            'label' => 'delete',
            'title' => __('general.Delete'),
            'key' => 'delete',
            'class' => 'btn btn-sm btn-danger mr-1',
            'url' => url(config('simple-table.route-prefix').'/'.\App\User::ENTITY_ROUTE_PREFIX.'/{id}'),
            'dataToggle' => 'modal',
            'dataTarget' => '#modalConfirm',
            'requestMethod' => 'DELETE',
            'modalText' => __('general.Confirmation delete')
        ],
        [
            'label' => 'block',
            'title' => __('general.Ban'),
            'key' => 'ban',
            'class' => 'btn btn-sm btn-danger mr-1',
            'url' => url(config('simple-table.route-prefix').'/'.\App\User::ENTITY_ROUTE_PREFIX.'/{id}/ban'),
            'dataToggle' => 'modal',
            'dataTarget' => '#modalConfirm',
            'requestMethod' => 'POST',
            'modalText' => __('general.Ban user')
        ],
        [
            'label' => 'refresh',
            'title' => __('general.Unban'),
            'key' => 'unban',
            'class' => 'btn btn-sm btn-success mr-1',
            'url' => url(config('simple-table.route-prefix').'/'.\App\User::ENTITY_ROUTE_PREFIX.'/{id}/unban'),
            'dataToggle' => 'modal',
            'dataTarget' => '#modalConfirm',
            'requestMethod' => 'POST',
            'modalText' => __('general.Unban user')
        ],
        [
            'label' => 'email',
            'title' => __('general.Reset mail'),
            'key' => 'passwordReset',
            'class' => 'btn btn-sm btn-info',
            'url' => url('password/email'),
            'dataToggle' => 'modal',
            'dataTarget' => '#modalConfirm',
            'requestMethod' => 'POST',
            'modalText' => __('general.Reset user password')
        ]
    ];

    $gridview = new \App\Helpers\SimpleTable($columns, $data, \App\User::ENTITY_ROUTE_PREFIX, $config, $actions);
@endphp
@extends ('admin.layouts.app')
@section ('content')
    <div class="card">
        <div class="card-header">{{__('user.User list')}}</div>
        <div class="card-body">
            <div class="form-group form-row">
                <a role="button" class="btn btn-primary btn-sm" href="{{ route('admin.users.create') }}">{{__('general.Create')}}</a>
            </div>
            <?= $gridview->render(); ?>
        </div>
    </div>
@endsection
