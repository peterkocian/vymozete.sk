<div class="card">
    @if(isset($title))
        <div class="card-header">
            {{ $title }}
        </div>
    @endif
    <div class="card-body">
        @if($data->getMorphClass() === \App\Models\Person::class )
{{--        @if($data->person_type === 'FO') todo prepisat v celom kode person_type na entity_type -> morph attribute--}}
            @include('admin.claims.tabs.partials.person')
        @elseif($data->getMorphClass() === \App\Models\Organization::class )
{{--        @elseif($data->person_type === 'PO')--}}
            @include('admin.claims.tabs.partials.organization')
        @endif

        @include('admin.claims.tabs.partials.contact-info')
        @include('admin.claims.tabs.partials.address')

        <div class="form-group row">
            <label for="created_at" class="col-sm-2 col-form-label">{{__('general.Created at')}}</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="created_at" value="{{ \Carbon\Carbon::parse($data->created_at)->format('d.m.Y H:i:s') }}" disabled/>
            </div>
        </div>
        <div class="form-group row">
            <label for="updated_at" class="col-sm-2 col-form-label">{{__('general.Updated at')}}</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="updated_at" value="{{ \Carbon\Carbon::parse($data->updated_at)->format('d.m.Y H:i:s') }}" disabled/>
            </div>
        </div>
    </div>
</div>
