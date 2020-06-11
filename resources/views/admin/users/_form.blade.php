<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">{{__('user.Name')}}</label>
    <div class="col-sm-10">
        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" type="text" name="name" value="{{ old('name', $user->name ?? null) }}" required/>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="surname" class="col-sm-2 col-form-label">{{__('user.Surname')}}</label>
    <div class="col-sm-10">
        <input class="form-control {{ $errors->has('surname') ? 'is-invalid' : '' }}" id="surname" type="text" name="surname" value="{{ old('surname', $user->surname ?? null) }}" required/>
        @error('surname')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">{{__('user.Email')}}</label>
    <div class="col-sm-10">
        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" type="email" name="email" value="{{ old('email', $user->email ?? null) }}" required/>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
@if($dontRequiredPassword)
    <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">{{__('user.Password')}}</label>
        <div class="col-sm-10">
            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" type="password" name="password"/>
            @foreach ($errors->get('password') as $message)
                <div class="invalid-feedback">{{ $message }}</div>
            @endforeach
        </div>
    </div>
    <div class="form-group row">
        <label for="password_confirmation" class="col-sm-2 col-form-label">{{__('user.Password confirmation')}}</label>
        <div class="col-sm-10">
            <input class="form-control" id="password_confirmation" type="password" name="password_confirmation"/>
        </div>
    </div>
@else
    <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">{{__('user.Password')}}</label>
        <div class="col-sm-10">
            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" type="password" name="password" value="{{ old('password', $user->password ?? null) }}" required/>
            @foreach ($errors->get('password') as $message)
                <div class="invalid-feedback">{{ $message }}</div>
            @endforeach
        </div>
    </div>
    <div class="form-group row">
        <label for="password_confirmation" class="col-sm-2 col-form-label">{{__('user.Password confirmation')}}</label>
        <div class="col-sm-10">
            <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" required/>
        </div>
    </div>
@endif
<div class="form-group row">
    <label for="roles" class="col-sm-2 col-form-label">{{__('user.Roles')}}</label>
    <div class="col-sm-10">
        <select multiple class="form-control" name="roles[]" id="roles">
            @foreach($user->roleList() as $role)
                <option value="{{ $role->id }}" @foreach($user->roles as $selectedRole) @if($selectedRole->id == $role->id)selected="selected"@endif @endforeach>{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="permissions" class="col-sm-2 col-form-label">{{__('user.Permissions')}}</label>
    <div class="col-sm-10">
        <select multiple class="form-control" name="permissions[]" id="permissions">
            @foreach($user->permissionList() as $permission)
                <option value="{{ $permission->id }}" @foreach($user->permissions as $selectedPermission) @if($selectedPermission->id == $permission->id)selected="selected"@endif @endforeach>{{ $permission->name }}</option>
            @endforeach
        </select>
    </div>
</div>
