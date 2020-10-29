<div class="form-group row">
    <label for="phone" class="col-sm-2 col-form-label">{{__('general.Phone')}}</label>
    <div class="col-sm-10">
        <input class="form-control" type="text" name="phone" value="{{ $data->phone }}" disabled/>
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">{{__('general.Email')}}</label>
    <div class="col-sm-10">
        <input class="form-control" type="text" name="email" value="{{ $data->email }}" disabled/>
    </div>
</div>
