<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.Company name')}}</label>
    <div class="col-sm-10">
        <input class="form-control form-control-sm" type="text" name="name" value="{{ $data->name }}" disabled/>
    </div>
</div>
<div class="form-group row">
    <label for="ico" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.ICO')}}</label>
    <div class="col-sm-10">
        <input class="form-control form-control-sm" type="text" name="ico" value="{{ $data->ico }}" disabled/>
    </div>
</div>
<div class="form-group row">
    <label for="vat" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.VAT')}}</label>
    <div class="col-sm-10">
        <input class="form-control form-control-sm" type="text" name="vat" value="{{ $data->vat }}" disabled/>
    </div>
</div>
