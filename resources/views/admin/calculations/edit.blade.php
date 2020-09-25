@extends ('admin.layouts.app')
@section ('content')
    <div class="card">
        <div class="card-header">{{__('calculation.Title')}}</div>
        <div class="card-body">
            <form method="post" action="{{route('admin.claims.calculations.update', [$claim_id, $data['id']])}}">
                @csrf
                @method('put')
                @include('admin.calculations._form', [])
                <div class="text-right">
                    <button type="submit" class="btn btn-success btn-sm">{{__('general.Save')}}</button>
                    <a role="button" class="btn btn-secondary btn-sm" href="{{url()->previous()}}">{{__('general.Back')}}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
