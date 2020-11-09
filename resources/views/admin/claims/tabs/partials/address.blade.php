<div class="form-group row">
    <label for="street" class="col-12 col-sm-3 col-form-label">{{__('general.Street')}}</label>
    <div class="col-12 col-sm-9">
        <input class="form-control" type="text" name="street" value="{{ $data->street }}" disabled/>
    </div>
</div>
<div class="form-group row">
    <label for="house_number" class="col-12 col-sm-3 col-form-label">{{__('general.House number')}}</label>
    <div class="col-12 col-sm-9">
        <input class="form-control" type="text" name="house_number" value="{{ $data->house_number }}" disabled/>
    </div>
</div>
<div class="form-group row">
    <label for="town" class="col-12 col-sm-3 col-form-label">{{__('general.Town')}}</label>
    <div class="col-12 col-sm-9">
        <input class="form-control" type="text" name="town" value="{{ $data->town }}" disabled/>
    </div>
</div>
<div class="form-group row">
    <label for="zip" class="col-12 col-sm-3 col-form-label">{{__('general.ZIP')}}</label>
    <div class="col-12 col-sm-9">
        <input class="form-control" type="text" name="zip" value="{{ $data->zip }}" disabled/>
    </div>
</div>
<div class="form-group row">
    <label for="country" class="col-12 col-sm-3 col-form-label">{{__('general.Country')}}</label>
    <div class="col-12 col-sm-9">
        <input class="form-control" type="text" name="country" value="{{ $data->country }}" disabled/>
    </div>
</div>
