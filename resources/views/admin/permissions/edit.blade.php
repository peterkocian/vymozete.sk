@extends ('admin.layouts.app')
@section ('content')
    <div class="card">
        <div class="card-header">{{__('permission.Title')}}</div>
        <div class="card-body">
            <form method="post" action="{{route('admin.permissions.update', $data['id'])}}">
                @csrf
                @method('put')
                @include('admin.permissions._form', [])
                <div class="text-right">
                    <button type="submit" class="btn btn-success btn-sm">{{__('general.Save')}}</button>
                    <a role="button" class="btn btn-secondary btn-sm" href="{{url()->previous()}}">{{__('general.Back')}}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
