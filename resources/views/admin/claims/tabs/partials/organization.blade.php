<div class="form-group row">
    <label for="name" class="col-12 col-sm-3 col-form-label">{{__('general.Company name')}}</label>
    <div class="col-12 col-sm-9">
        <input class="form-control" type="text" name="name" value="{{ $data->name }}" disabled/>
    </div>
</div>
<div class="form-group row">
    <label for="ico" class="col-12 col-sm-3 col-form-label">{{__('general.ICO')}}</label>
    <div class="col-12 col-sm-9">
        <input class="form-control" type="text" name="ico" value="{{ $data->ico }}" disabled/>
    </div>
</div>
<div class="form-group row">
    <label for="vat" class="col-12 col-sm-3 col-form-label">{{__('general.VAT')}}</label>
    <div class="col-12 col-sm-9">
        <input class="form-control" type="text" name="vat" value="{{ $data->vat }}" disabled/>
    </div>
</div>
