<div class="row">
    <div class="col">
        @if($data->getMorphClass() === \App\Models\Person::class )
            @include('admin.claims.tabs.partials.person')
        @elseif($data->getMorphClass() === \App\Models\Organization::class )
            @include('admin.claims.tabs.partials.organization')
        @endif

        @include('admin.claims.tabs.partials.contact-info')
        @include('admin.claims.tabs.partials.address')

        <div class="form-group row">
            <label for="created_at" class="col-12 col-sm-3 col-form-label">{{__('general.Created at')}}</label>
            <div class="col-12 col-sm-9">
                <input class="form-control" type="text" name="created_at" value="{{ \Carbon\Carbon::parse($data->created_at)->format('d.m.Y H:i:s') }}" disabled/>
            </div>
        </div>
        <div class="form-group row">
            <label for="updated_at" class="col-12 col-sm-3 col-form-label">{{__('general.Updated at')}}</label>
            <div class="col-12 col-sm-9">
                <input class="form-control" type="text" name="updated_at" value="{{ \Carbon\Carbon::parse($data->updated_at)->format('d.m.Y H:i:s') }}" disabled/>
            </div>
        </div>
    </div>
</div>
