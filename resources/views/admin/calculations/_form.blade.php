<div class="form-group row">
    <label for="date" class="col-sm-2 col-form-label">{{__('calculation.Date')}}</label>
    <div class="col-sm-10">
        <input class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" type="date" name="date" id="date" value="{{ old('name', $data->date ?? null) }}" required/>
        @error('date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="amount" class="col-sm-2 col-form-label">{{__('calculation.Amount')}}</label>
    <div class="col-sm-10">
        <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" step="0.01" name="amount" id="amount" value="{{ old('name', $data->amount ?? null) }}" required/>
        @error('amount')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="currency_id" class="col-sm-2 col-form-label">{{__('calculation.Currency')}}</label>
    <div class="col-sm-10">
        <input class="form-control {{ $errors->has('currency_id') ? 'is-invalid' : '' }}" type="text" name="currency_id" id="currency_id" value="{{ old('name', $data->currency_id ?? null) }}" required/>
        @error('currency_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="paid" class="col-sm-2 col-form-label">{{__('calculation.Paid')}}</label>
    <div class="col-sm-10">
        <input class="form-control {{ $errors->has('paid') ? 'is-invalid' : '' }}" type="checkbox" name="paid" id="paid" value="{{ old('name', $data->paid ?? null) }}"/>
        @error('paid')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="description" class="col-sm-2 col-form-label">{{__('calculation.Description')}}</label>
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
