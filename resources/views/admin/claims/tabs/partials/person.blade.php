<div class="form-group row">
    <label for="name" class="col-12 col-sm-3 col-form-label">{{__('general.Name')}}</label>
    <div class="col-12 col-sm-9">
        <input class="form-control" type="text" name="name"  value="{{ $data->name }}" disabled/>
    </div>
</div>
<div class="form-group row">
    <label for="surname" class="col-12 col-sm-3 col-form-label">{{__('general.Surname')}}</label>
    <div class="col-12 col-sm-9">
        <input class="form-control" type="text" name="surname" value="{{ $data->surname }}" disabled/>
    </div>
</div>
<div class="form-group row">
    <label for="birthday" class="col-12 col-sm-3 col-form-label">{{__('general.Birthday')}}</label>
    <div class="col-12 col-sm-9">
        <input class="form-control" type="text" name="birthday" value="{{ $data->birthday }}" disabled/>
    </div>
</div>
<div class="form-group row">
    <label for="id_number" class="col-12 col-sm-3 col-form-label">{{__('general.ID number')}}</label>
    <div class="col-12 col-sm-9">
        <input class="form-control" type="text" name="id_number" value="{{ $data->id_number }}" disabled/>
    </div>
</div>
<div class="form-group row">
    <label for="citizenship" class="col-12 col-sm-3 col-form-label">{{__('general.Citizenship')}}</label>
    <div class="col-12 col-sm-9">
        <input class="form-control" type="text" name="citizenship" value="{{ $data->citizenship }}" disabled/>
    </div>
</div>
