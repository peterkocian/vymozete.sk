<div class="card">
    <div class="card-header">{{__('user.Title')}}</div>
    <div class="card-body">
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">{{__('user.Name')}}</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="name"  value="{{ $claim->amount }}" disabled/>
            </div>
        </div>
        <div class="form-group row">
            <label for="surname" class="col-sm-2 col-form-label">{{__('user.Surname')}}</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="surname" value="{{ $claim->debtor }}" disabled/>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">{{__('user.Email')}}</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="email" value="{{ $claim->creditor }}" disabled/>
            </div>
        </div>

        <div class="form-group row">
            <label for="created_at" class="col-sm-2 col-form-label">{{__('general.Created at')}}</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="created_at" value="{{ \Carbon\Carbon::parse($claim->created_at)->format('d.m.Y H:i:s') }}" disabled/>
            </div>
        </div>
        <div class="form-group row">
            <label for="updated_at" class="col-sm-2 col-form-label">{{__('general.Updated at')}}</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="updated_at" value="{{ \Carbon\Carbon::parse($claim->updated_at)->format('d.m.Y H:i:s') }}" disabled/>
            </div>
        </div>
    </div>
</div>
