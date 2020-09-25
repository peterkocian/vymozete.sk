@extends ('admin.layouts.app')
@section ('content')
    @php
        $actionDelete =[
            'url' => url(config('simple-table.route-prefix').'/'.\App\User::ENTITY_ROUTE_PREFIX.'/'.$user->id),
            'text' => __('general.Confirmation delete'),
            'requestMethod' => 'DELETE',
        ];
    @endphp
    <div class="form-group">
        <a role="button" class="btn btn-primary btn-sm" href="{{ route('admin.users.edit', $user->id) }}">{{__('general.Edit')}}</a>
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
        <div class="card-header">{{__('user.Title')}}</div>
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">{{__('user.Name')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="name"  value="{{ $user->name }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="surname" class="col-sm-2 col-form-label">{{__('user.Surname')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="surname" value="{{ $user->surname }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">{{__('user.Email')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="email" value="{{ $user->email }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="roles" class="col-sm-2 col-form-label">{{__('user.Roles')}}</label>
                <div class="col-sm-10">
                    <select multiple class="form-control" name="roles[]" id="roles" disabled>
                        @foreach($user->roleList() as $role)
                            <option value="{{ $role->id }}" @foreach($user->roles as $selectedRole) @if($selectedRole->id == $role->id)selected="selected"@endif @endforeach>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="permissions" class="col-sm-2 col-form-label">{{__('user.Permissions')}}</label>
                <div class="col-sm-10">
                    <select multiple class="form-control" name="permissions[]" id="permissions" disabled>
                        @foreach($user->permissionList() as $permission)
                            <option value="{{ $permission->id }}" @foreach($user->permissions as $selectedPermission) @if($selectedPermission->id == $permission->id)selected="selected"@endif @endforeach>{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="created_at" class="col-sm-2 col-form-label">{{__('general.Created at')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="created_at" value="{{ \Carbon\Carbon::parse($user->created_at)->format('d.m.Y H:i:s') }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="updated_at" class="col-sm-2 col-form-label">{{__('general.Updated at')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="updated_at" value="{{ \Carbon\Carbon::parse($user->updated_at)->format('d.m.Y H:i:s') }}" disabled/>
                </div>
            </div>
        </div>
    </div>
@endsection
