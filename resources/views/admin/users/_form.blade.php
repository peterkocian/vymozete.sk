<div class="form-group row">
    <label for="name" class="col-sm-3 col-form-label">{{__('user.Name')}}</label>
    <div class="col-sm-9">
        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" type="text" name="name" value="{{ old('name', $user->name ?? null) }}"  autofocus/>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="surname" class="col-sm-3 col-form-label">{{__('user.Surname')}}</label>
    <div class="col-sm-9">
        <input class="form-control {{ $errors->has('surname') ? 'is-invalid' : '' }}" id="surname" type="text" name="surname" value="{{ old('surname', $user->surname ?? null) }}" />
        @error('surname')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-sm-3 col-form-label">{{__('user.Email')}}</label>
    <div class="col-sm-9">
        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" type="email" name="email" value="{{ old('email', $user->email ?? null) }}" />
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="password" class="col-sm-3 col-form-label">{{__('user.Password')}}</label>
    <div class="col-sm-9">
        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" type="password" name="password" @if($requirePassword) value="{{ old('password', $user->password ?? null) }}"  @endif/>
        @foreach ($errors->get('password') as $message)
            <div class="invalid-feedback">{{ $message }}</div>
        @endforeach
    </div>
</div>
<div class="form-group row">
    <label for="password_confirmation" class="col-sm-3 col-form-label">{{__('user.Password confirmation')}}</label>
    <div class="col-sm-9">
        <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" @if($requirePassword) value="{{ old('password_confirmation') }}"  @endif/>
    </div>
</div>
<div class="form-group row">
    <label for="roles" class="col-sm-3 col-form-label">{{__('user.Roles')}}</label>
    <div class="col-sm-9">
        <select multiple class="form-control {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles">
            @foreach($user->roleList() as $role)
                <option value="{{ $role->id }}"
                    @foreach(old('roles', $user->roles ?? null) as $selectedRole)
                        @if(old('roles'))
                            @if($selectedRole == $role->id)selected="selected"@endif
                        @else
                            @if($selectedRole->id == $role->id)selected="selected"@endif
                        @endif
                    @endforeach>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
        @foreach ($errors->get('roles') as $message)
            <div class="invalid-feedback">{{ $message }}</div>
        @endforeach
    </div>
</div>
<div class="form-group row">
    <label for="permissions" class="col-sm-3 col-form-label">{{__('user.Permissions')}}</label>
    <div class="col-sm-9">
        <select multiple class="form-control {{ $errors->has('permissions') ? 'is-invalid' : '' }}" name="permissions[]" id="permissions">
            @foreach($user->permissionList() as $permission)
                <option value="{{ $permission->id }}"
                    @foreach(old('permissions', $user->permissions ?? null) as $selectedPermission)
                        @if(old('permissions'))
                            @if($selectedPermission == $permission->id)selected="selected"@endif
                        @else
                            @if($selectedPermission->id == $permission->id)selected="selected"@endif
                        @endif
                    @endforeach>
                    {{ $permission->name }}
                </option>
            @endforeach
        </select>
        @foreach ($errors->get('permissions') as $message)
            <div class="invalid-feedback">{{ $message }}</div>
        @endforeach
    </div>
</div>
