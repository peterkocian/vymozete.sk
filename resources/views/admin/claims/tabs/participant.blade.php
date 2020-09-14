<div class="card">
    <div class="card-body">
        @if($data->person_type === 'FO')
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.Name')}}</label>
                <div class="col-sm-10">
                    <input class="form-control form-control-sm" type="text" name="name"  value="{{ $data->entity->name }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="surname" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.Surname')}}</label>
                <div class="col-sm-10">
                    <input class="form-control form-control-sm" type="text" name="surname" value="{{ $data->entity->surname }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="birthday" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.Birthday')}}</label>
                <div class="col-sm-10">
                    <input class="form-control form-control-sm" type="text" name="birthday" value="{{ $data->entity->birthday }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="id_number" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.ID number')}}</label>
                <div class="col-sm-10">
                    <input class="form-control form-control-sm" type="text" name="id_number" value="{{ $data->entity->id_number }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="citizenship" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.Citizenship')}}</label>
                <div class="col-sm-10">
                    <input class="form-control form-control-sm" type="text" name="citizenship" value="{{ $data->entity->citizenship }}" disabled/>
                </div>
            </div>
        @elseif($data->person_type === 'PO')
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.Company name')}}</label>
                <div class="col-sm-10">
                    <input class="form-control form-control-sm" type="text" name="name" value="{{ $data->entity->name }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="ico" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.ICO')}}</label>
                <div class="col-sm-10">
                    <input class="form-control form-control-sm" type="text" name="ico" value="{{ $data->entity->ico }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="vat" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.VAT')}}</label>
                <div class="col-sm-10">
                    <input class="form-control form-control-sm" type="text" name="vat" value="{{ $data->entity->vat }}" disabled/>
                </div>
            </div>
        @endif
        <div class="form-group row">
            <label for="phone" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.Phone')}}</label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" type="text" name="phone" value="{{ $data->entity->phone }}" disabled/>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.Email')}}</label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" type="text" name="email" value="{{ $data->entity->email }}" disabled/>
            </div>
        </div>
        <div class="form-group row">
            <label for="street" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.Street')}}</label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" type="text" name="street" value="{{ $data->entity->street }}" disabled/>
            </div>
        </div>
        <div class="form-group row">
            <label for="house_number" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.House number')}}</label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" type="text" name="house_number" value="{{ $data->entity->house_number }}" disabled/>
            </div>
        </div>
        <div class="form-group row">
            <label for="town" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.Town')}}</label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" type="text" name="town" value="{{ $data->entity->town }}" disabled/>
            </div>
        </div>
        <div class="form-group row">
            <label for="zip" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.ZIP')}}</label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" type="text" name="zip" value="{{ $data->entity->zip }}" disabled/>
            </div>
        </div>
        <div class="form-group row">
            <label for="country" class="col-sm-2 col-form-label col-form-label-sm">{{__('general.Country')}}</label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" type="text" name="country" value="{{ $data->entity->country }}" disabled/>
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
    </div>
</div>
