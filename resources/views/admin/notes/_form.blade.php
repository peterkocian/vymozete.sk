<div class="form-group row">
    <label for="title" class="col-sm-2 col-form-label">{{__('note.Title')}}</label>
    <div class="col-sm-10">
        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('name', $data->title ?? null) }}" required/>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="description" class="col-sm-2 col-form-label">{{__('note.Description')}}</label>
    <div class="col-sm-10">
        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('name', $data->description ?? null) }}</textarea>
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="created_at" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.Created at')}}</label>
    <div class="col-sm-10">
        <input class="form-control form-control-sm" type="text" name="created_at" value="{{ \Carbon\Carbon::parse($data->created_at)->format('d.m.Y H:i:s') }}" disabled/>
    </div>
</div>
<div class="form-group row">
    <label for="updated_at" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.Updated at')}}</label>
    <div class="col-sm-10">
        <input class="form-control form-control-sm" type="text" name="updated_at" value="{{ \Carbon\Carbon::parse($data->updated_at)->format('d.m.Y H:i:s') }}" disabled/>
    </div>
</div>
