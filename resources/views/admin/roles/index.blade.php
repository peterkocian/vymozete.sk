@php
    $columns = [
        [
            'label' => __('role.Name'),
            'key' => 'name',
            'type' => 'text'
        ],
        [
            'label' => __('role.Slug'),
            'key' => 'slug',
            'type' => 'text'
        ],
        [
            'label' => __('general.Created at'),
            'key' => 'created_at',
            'type' => 'date'
        ],
    ];

    $config = [
        'reloadUrl'     => "/admin/roles",
        'showPagination' => \App\Models\Role::INDEX_VIEW_PAGINATION,
        'itemsPerPage'  => [50, 100, 150],
        'numberOfRows'  => 50,
        'sortKey'       => 'created_at',
        'sortDirection' => 'asc',
    ];

    $gridview = new \App\Helpers\SimpleTable($columns, $data, \App\Models\Role::ENTITY_ROUTE_PREFIX, $config);
@endphp
@extends ('admin.layouts.app')
@section ('content')
    <div class="card">
        <div class="card-header">{{__('role.Role list')}}</div>
        <div class="card-body">
            <div class="form-group form-row">
                <a role="button" class="btn btn-primary btn-sm" href="{{ route('admin.roles.create') }}">{{__('general.Create')}}</a>
            </div>
            <?= $gridview->render(); ?>
        </div>
    </div>
@endsection
