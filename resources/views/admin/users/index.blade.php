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

    $gridview = new \App\Helpers\SimpleTable($columns, $data, \App\User::ENTITY_ROUTE_PREFIX);
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
