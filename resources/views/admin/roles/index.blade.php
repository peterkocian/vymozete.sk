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
        'showPerPageSelect' => \App\Models\Role::INDEX_VIEW_PER_PAGE_SELECT,
        'itemsPerPage'  => \App\Helpers\SimpleTable::ITEMS_PER_PAGE,
        'numberOfRows'  => \App\Helpers\SimpleTable::NUMBER_OF_ROWS,
        'sortKey'       => \App\Helpers\SimpleTable::SORT_KEY,
        'sortDirection' => \App\Helpers\SimpleTable::SORT_DIRECTION,
    ];

    $gridview = new \App\Helpers\SimpleTable($columns, $data, \App\Models\Role::ENTITY_ROUTE_PREFIX, $config);
@endphp
@extends ('admin.layouts.app')
@section ('content')
    <div class="card">
        <div class="card-header">{{__('role.Role list')}}</div>
        <div class="card-body">
            <div class="form-group form-row">
                <a role="button" title="@lang('general.Create')" class="btn btn-primary btn-sm" href="{{ route('admin.roles.create') }}"><span class="material-icons">add</span></a>
            </div>
            <?= $gridview->render(); ?>
        </div>
    </div>
@endsection
