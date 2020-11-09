<div class="form-group row">
    <label for="name" class="col-sm-3 col-form-label">{{__('permission.Name')}}</label>
    <div class="col-sm-9">
        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $permission->name ?? null) }}" required/>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
{{--<div class="form-group row">--}}
{{--    <label for="slug" class="col-sm-3 col-form-label">{{__('permission.Slug')}}</label>--}}
{{--    <div class="col-sm-9">--}}
{{--        <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $permission->slug ?? null) }}" required/>--}}
{{--        @error('slug')--}}
{{--            <div class="invalid-feedback">{{ $message }}</div>--}}
{{--        @enderror--}}
{{--    </div>--}}
{{--</div>--}}
