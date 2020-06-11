@extends ('admin.layouts.app')
@section ('content')
    <div class="card">
        <div class="card-header">{{__('role.Title')}}</div>
        <div class="card-body">
            <form method="post" action="{{route('admin.roles.update', $role->id)}}">
                @csrf
                @method('put')
                @include('admin.roles._form', [])
                <div class="text-right">
                    <button type="submit" class="btn btn-success btn-sm">{{__('general.Save')}}</button>
                    <a role="button" class="btn btn-secondary btn-sm" href="{{url()->previous()}}">{{__('general.Back')}}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
