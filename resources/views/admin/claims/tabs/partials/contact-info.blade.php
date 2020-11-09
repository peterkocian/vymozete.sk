@if($data->iban)
    <div class="form-group row">
        <label for="created_at" class="col-12 col-sm-3 col-form-label">{{__('general.IBAN')}}</label>
        <div class="col-12 col-sm-9">
            <input class="form-control" type="text" name="iban" value="{{ $data->iban }}" disabled/>
        </div>
    </div>
@endif
<div class="form-group row">
    <label for="phone" class="col-12 col-sm-3 col-form-label">{{__('general.Phone')}}</label>
    <div class="col-12 col-sm-9">
        <input class="form-control" type="text" name="phone" value="{{ $data->phone }}" disabled/>
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-12 col-sm-3 col-form-label">{{__('general.Email')}}</label>
    <div class="col-12 col-sm-9">
        <input class="form-control" type="text" name="email" value="{{ $data->email }}" disabled/>
    </div>
</div>
