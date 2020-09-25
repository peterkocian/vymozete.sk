<div class="form-group row">
    <label for="phone" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.Phone')}}</label>
    <div class="col-sm-10">
        <input class="form-control form-control-sm" type="text" name="phone" value="{{ $data->phone }}" disabled/>
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.Email')}}</label>
    <div class="col-sm-10">
        <input class="form-control form-control-sm" type="text" name="email" value="{{ $data->email }}" disabled/>
    </div>
</div>
