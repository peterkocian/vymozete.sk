@extends ('admin.layouts.app')
@section ('content')
    @php
        $actionDelete =[
            'url' => url(config('simple-table.route-prefix').'/'.\App\Models\Role::ENTITY_ROUTE_PREFIX.'/'.$role->id),
            'text' => __('general.Confirmation delete'),
            'requestMethod' => 'DELETE',
        ];
    @endphp
    <div class="form-group">
        <a role="button" class="btn btn-primary btn-sm" href="{{ route('admin.roles.edit', $role->id) }}">{{__('general.Edit')}}</a>
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
                    <input class="form-control" type="text" name="name"  value="{{ $role->name }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="surname" class="col-sm-3 col-form-label">{{__('role.Slug')}}</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" name="slug" value="{{ $role->slug }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="permissions" class="col-sm-3 col-form-label">{{__('role.Permissions')}}</label>
                <div class="col-sm-9">
                    <select multiple class="form-control" name="permissions[]" id="permissions" disabled>
                        @foreach($role->permissionList() as $permission)
                            <option value="{{ $permission->id }}" @foreach($role->permissions as $selectedPermission) @if($selectedPermission->id == $permission->id)selected="selected"@endif @endforeach>{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="created_at" class="col-sm-3 col-form-label">{{__('general.Created at')}}</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" name="created_at" value="{{ \Carbon\Carbon::parse($role->created_at)->format('d.m.Y H:i:s') }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="updated_at" class="col-sm-3 col-form-label">{{__('general.Updated at')}}</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" name="updated_at" value="{{ \Carbon\Carbon::parse($role->updated_at)->format('d.m.Y H:i:s') }}" disabled/>
                </div>
            </div>
        </div>
    </div>
@endsection
