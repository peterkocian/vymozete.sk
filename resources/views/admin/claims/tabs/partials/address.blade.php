<div class="form-group row">
    <label for="street" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.Street')}}</label>
    <div class="col-sm-10">
        <input class="form-control form-control-sm" type="text" name="street" value="{{ $data->street }}" disabled/>
    </div>
</div>
<div class="form-group row">
    <label for="house_number" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.House number')}}</label>
    <div class="col-sm-10">
        <input class="form-control form-control-sm" type="text" name="house_number" value="{{ $data->house_number }}" disabled/>
    </div>
</div>
<div class="form-group row">
    <label for="town" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.Town')}}</label>
    <div class="col-sm-10">
        <input class="form-control form-control-sm" type="text" name="town" value="{{ $data->town }}" disabled/>
    </div>
</div>
<div class="form-group row">
    <label for="zip" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.ZIP')}}</label>
    <div class="col-sm-10">
        <input class="form-control form-control-sm" type="text" name="zip" value="{{ $data->zip }}" disabled/>
    </div>
</div>
<div class="form-group row">
    <label for="country" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.Country')}}</label>
    <div class="col-sm-10">
        <input class="form-control form-control-sm" type="text" name="country" value="{{ $data->country }}" disabled/>
    </div>
</div>
