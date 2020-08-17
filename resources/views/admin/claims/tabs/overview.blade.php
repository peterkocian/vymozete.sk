<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label">{{__('claim.Amount')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="name"  value="{{ $claim->amountWithCurrency }}" disabled/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="surname" class="col-sm-4 col-form-label">{{__('claim.Debtor')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="surname" value="{{ $claim->debtor->entity->fullname }}" disabled/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label">{{__('claim.Creditor')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="email" value="{{ $claim->creditor->entity->fullname }}" disabled/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="created_at" class="col-sm-4 col-form-label">{{__('general.Created at')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="created_at" value="{{ \Carbon\Carbon::parse($claim->created_at)->format('d.m.Y H:i:s') }}" disabled/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="updated_at" class="col-sm-4 col-form-label">{{__('general.Updated at')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="updated_at" value="{{ \Carbon\Carbon::parse($claim->updated_at)->format('d.m.Y H:i:s') }}" disabled/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label">{{__('claim.Amount')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="name"  value="{{ $claim->amountWithCurrency }}" disabled/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="surname" class="col-sm-4 col-form-label">{{__('claim.Debtor')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="surname" value="{{ $claim->debtor->entity->fullname }}" disabled/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label">{{__('claim.Creditor')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="email" value="{{ $claim->creditor->entity->fullname }}" disabled/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="created_at" class="col-sm-4 col-form-label">{{__('general.Created at')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="created_at" value="{{ \Carbon\Carbon::parse($claim->created_at)->format('d.m.Y H:i:s') }}" disabled/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="updated_at" class="col-sm-4 col-form-label">{{__('general.Updated at')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="updated_at" value="{{ \Carbon\Carbon::parse($claim->updated_at)->format('d.m.Y H:i:s') }}" disabled/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label">{{__('claim.Amount')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="name"  value="{{ $claim->amountWithCurrency }}" disabled/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="surname" class="col-sm-4 col-form-label">{{__('claim.Debtor')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="surname" value="{{ $claim->debtor->entity->fullname }}" disabled/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label">{{__('claim.Creditor')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="email" value="{{ $claim->creditor->entity->fullname }}" disabled/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="created_at" class="col-sm-4 col-form-label">{{__('general.Created at')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="created_at" value="{{ \Carbon\Carbon::parse($claim->created_at)->format('d.m.Y H:i:s') }}" disabled/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="updated_at" class="col-sm-4 col-form-label">{{__('general.Updated at')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="updated_at" value="{{ \Carbon\Carbon::parse($claim->updated_at)->format('d.m.Y H:i:s') }}" disabled/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label">{{__('claim.Amount')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="name"  value="{{ $claim->amountWithCurrency }}" disabled/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="surname" class="col-sm-4 col-form-label">{{__('claim.Debtor')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="surname" value="{{ $claim->debtor->entity->fullname }}" disabled/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label">{{__('claim.Creditor')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="email" value="{{ $claim->creditor->entity->fullname }}" disabled/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="created_at" class="col-sm-4 col-form-label">{{__('general.Created at')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="created_at" value="{{ \Carbon\Carbon::parse($claim->created_at)->format('d.m.Y H:i:s') }}" disabled/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="updated_at" class="col-sm-4 col-form-label">{{__('general.Updated at')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="updated_at" value="{{ \Carbon\Carbon::parse($claim->updated_at)->format('d.m.Y H:i:s') }}" disabled/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label">{{__('claim.Amount')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="name"  value="{{ $claim->amountWithCurrency }}" disabled/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="surname" class="col-sm-4 col-form-label">{{__('claim.Debtor')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="surname" value="{{ $claim->debtor->entity->fullname }}" disabled/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label">{{__('claim.Creditor')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="email" value="{{ $claim->creditor->entity->fullname }}" disabled/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="created_at" class="col-sm-4 col-form-label">{{__('general.Created at')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="created_at" value="{{ \Carbon\Carbon::parse($claim->created_at)->format('d.m.Y H:i:s') }}" disabled/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="updated_at" class="col-sm-4 col-form-label">{{__('general.Updated at')}}</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="updated_at" value="{{ \Carbon\Carbon::parse($claim->updated_at)->format('d.m.Y H:i:s') }}" disabled/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
