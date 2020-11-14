@extends ('admin.layouts.app')
@section ('content')
    @php
        $actionDelete =[
            'url' => url(config('simple-table.route-prefix').'/'.\App\Models\Permission::ENTITY_ROUTE_PREFIX.'/'.$permission->id),
            'text' => __('general.Confirmation delete'),
            'requestMethod' => 'DELETE',
        ];
    @endphp
    <div class="form-group">
        <a role="button" class="btn btn-primary btn-sm" href="{{ route('admin.permissions.edit', $permission->id) }}">{{__('general.Edit')}}</a>
        <a
            role="button"
            href="#"
            class = "btn btn-sm btn-danger"
            data-toggle="modal"
            data-target="#modalConfirm"
        >{{ __('general.Delete') }}</a>
        <modal-component
                :config="{{ json_encode($actionDelete) }}">
        </modal-component>
    </div>
    <div class="card">
        <div class="card-header">{{__('role.Title')}}</div>
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">{{__('role.Name')}}</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" name="name"  value="{{ $permission->name }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="surname" class="col-sm-3 col-form-label">{{__('role.Slug')}}</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" name="slug" value="{{ $permission->slug }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="created_at" class="col-sm-3 col-form-label">{{__('general.Created at')}}</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" name="created_at" value="{{ $permission->created_at }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="updated_at" class="col-sm-3 col-form-label">{{__('general.Updated at')}}</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" name="updated_at" value="{{ $permission->updated_at }}" disabled/>
                </div>
            </div>
        </div>
    </div>
@endsection
