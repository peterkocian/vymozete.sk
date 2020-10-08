@php
    $columns = [
        [
            'label' => __('permission.Name'),
            'key' => 'name',
            'type' => 'text'
        ],
        [
            'label' => __('permission.Slug'),
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
        'reloadUrl'     => "/admin/permissions",
        'showPagination' => \App\Models\Permission::INDEX_VIEW_PAGINATION,
        'showPerPageSelect' => \App\Models\Permission::INDEX_VIEW_PER_PAGE_SELECT,
        'itemsPerPage'  => \App\Helpers\SimpleTable::ITEMS_PER_PAGE,
        'numberOfRows'  => \App\Helpers\SimpleTable::NUMBER_OF_ROWS,
        'sortKey'       => \App\Helpers\SimpleTable::SORT_KEY,
        'sortDirection' => \App\Helpers\SimpleTable::SORT_DIRECTION,
    ];

    $gridview = new \App\Helpers\SimpleTable($columns, $data, \App\Models\Permission::ENTITY_ROUTE_PREFIX, $config);
@endphp
@extends ('admin.layouts.app')
@section ('content')
    <div class="card">
        <div class="card-header">{{__('permission.Permission list')}}</div>
        <div class="card-body">
            <div class="form-group form-row">
                <a role="button" title="@lang('general.Create')" class="btn btn-primary btn-sm" href="{{ route('admin.permissions.create') }}"><span class="material-icons">add</span></a>
            </div>
            <?= $gridview->render(); ?>
        </div>
    </div>
@endsection
