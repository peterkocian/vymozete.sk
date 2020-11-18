<div class="form-group row">
    <label for="date" class="col-sm-3 col-form-label">{{__('calculation.Date')}}</label>
    <div class="col-sm-9">
        <input class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" type="date" name="date" id="date" value="{{ old('date', \Carbon\Carbon::parse($data->date)->format('Y-m-d') ?? null) }}"/>
        @error('date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="amount" class="col-sm-3 col-form-label">{{__('calculation.Amount')}}</label>
    <div class="col-sm-9">
        <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" step="0.01" name="amount" id="amount" value="{{ old('amount', $data->amount ?? null) }}"/>
        @error('amount')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="currency_id" class="col-sm-3 col-form-label">{{__('calculation.Currency')}}</label>
    <div class="col-sm-9">
        <select class="form-control {{ $errors->has('currency_id') ? 'is-invalid' : '' }}" name="currency_id" id="currency_id" >
            @foreach($currencies as $currency)
                <option value="{{ $currency['id'] }}"
                    @if(old('currency_id') == $currency['id'] || $data['currency_id'] == $currency['id'])selected="selected"@endif
                >
                    {{ $currency['value'] }}
                </option>
            @endforeach
        </select>
        @error('currency_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="paid" class="col-sm-3 col-form-label">{{__('calculation.Paid')}}</label>
    <div class="col-sm-9">
        <input class="form-control {{ $errors->has('paid') ? 'is-invalid' : '' }}" type="checkbox" name="paid" id="paid" value="{{ old('paid', 1) }}" @if(old('paid', $data->paid ?? null) == 1) checked @endif/>
        @error('paid')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="description" class="col-sm-3 col-form-label">{{__('calculation.Description')}}</label>
    <div class="col-sm-9">
        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $data->description ?? null) }}</textarea>
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
