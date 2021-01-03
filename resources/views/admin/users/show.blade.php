@extends ('admin.layouts.app')
@section ('content')
    @php
        $actionDelete =[
            'url' => url(config('simple-table.route-prefix').'/'.\App\Models\User::ENTITY_ROUTE_PREFIX.'/'.$user->id),
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
                <label for="name" class="col-sm-3 col-form-label">{{__('user.Name')}}</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" name="name"  value="{{ $user->name }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="surname" class="col-sm-3 col-form-label">{{__('user.Surname')}}</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" name="surname" value="{{ $user->surname }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">{{__('user.Email')}}</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" name="email" value="{{ $user->email }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="roles" class="col-sm-3 col-form-label">{{__('user.Roles')}}</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" name="roles" value="{{ $user->rolesToString() }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="permissions" class="col-sm-3 col-form-label">{{__('user.Permissions')}}</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" name="permissions" value="{{ $user->permissionsToString() }}" disabled/>
                </div>
            </div>

            <div class="form-group row">
                <label for="created_at" class="col-sm-3 col-form-label">{{__('general.Created at')}}</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" name="created_at" value="{{ $user->created_at }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="updated_at" class="col-sm-3 col-form-label">{{__('general.Updated at')}}</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" name="updated_at" value="{{ $user->updated_at }}" disabled/>
                </div>
            </div>
        </div>
    </div>
@endsection
