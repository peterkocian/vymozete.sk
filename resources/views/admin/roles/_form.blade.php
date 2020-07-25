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
        <select multiple class="form-control {{ $errors->has('permissions') ? 'is-invalid' : '' }}" name="permissions[]" id="permissions">
            @foreach($role->permissionList() as $permission)
                <option value="{{ $permission->id }}"
                    @foreach(old('permissions', $role->permissions ?? null) as $selectedPermission)
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

