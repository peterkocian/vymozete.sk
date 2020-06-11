<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">{{__('role.Name')}}</label>
    <div class="col-sm-10">
        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $role->name ?? null) }}" required/>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
{{--<div class="form-group row">--}}
{{--    <label for="slug" class="col-sm-2 col-form-label">{{__('role.Slug')}}</label>--}}
{{--    <div class="col-sm-10">--}}
{{--        <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $role->slug ?? null) }}" required/>--}}
{{--        @error('slug')--}}
{{--            <div class="invalid-feedback">{{ $message }}</div>--}}
{{--        @enderror--}}
{{--    </div>--}}
{{--</div>--}}
<div class="form-group row">
    <label for="permissions" class="col-sm-2 col-form-label">{{__('role.Permissions')}}</label>
    <div class="col-sm-10">
        <select multiple class="form-control" name="permissions[]" id="permissions">
            @foreach($role->permissionList() as $permission)
                <option value="{{ $permission->id }}" @foreach($role->permissions as $selectedPermission) @if($selectedPermission->id == $permission->id)selected="selected"@endif @endforeach>{{ $permission->name }}</option>
            @endforeach
        </select>
    </div>
</div>

