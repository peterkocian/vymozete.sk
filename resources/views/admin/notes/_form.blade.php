<div class="form-group row">
    <label for="title" class="col-sm-2 col-form-label">{{__('note.Title')}}</label>
    <div class="col-sm-10">
        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('name', $note->title ?? null) }}" required/>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="description" class="col-sm-2 col-form-label">{{__('note.Description')}}</label>
    <div class="col-sm-10">
        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('name', $note->description ?? null) }}</textarea>
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
