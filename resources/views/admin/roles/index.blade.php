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

    $gridview = new \App\Helpers\SimpleTable($columns, $data, \App\Models\Admin\Role::ENTITY_ROUTE_PREFIX);
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
