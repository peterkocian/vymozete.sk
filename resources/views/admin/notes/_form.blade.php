<div class="form-group row">
    <label for="title" class="col-sm-3 col-form-label">{{__('note.Title')}}</label>
    <div class="col-sm-9">
        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $data->title ?? null) }}" required/>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="description" class="col-sm-3 col-form-label">{{__('note.Description')}}</label>
    <div class="col-sm-9">
        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description', $data->description ?? null) }}</textarea>
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="created_at" class="col-sm-3 col-form-label">{{__('general.Created at')}}</label>
    <div class="col-sm-9">
        <input class="form-control" type="text" name="created_at" value="{{ $data->created_at }}" disabled/>
    </div>
</div>
<div class="form-group row">
    <label for="updated_at" class="col-sm-3 col-form-label">{{__('general.Updated at')}}</label>
    <div class="col-sm-9">
        <input class="form-control" type="text" name="updated_at" value="{{ $data->updated_at }}" disabled/>
    </div>
</div>
