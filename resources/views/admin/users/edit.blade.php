@extends ('admin.layouts.app')
@section ('content')
    <div class="card">
        <div class="card-header">{{__('user.Title')}}</div>
        <div class="card-body">
            <form method="post" action="{{route('admin.users.update', $user->id)}}">
                @csrf
                @method('put')
                @include('admin.users._form', ['requirePassword' => false])
                <div class="text-right">
                    <button type="submit" class="btn btn-success btn-sm">{{__('general.Save')}}</button>
                    <a role="button" class="btn btn-secondary btn-sm" href="{{url()->previous()}}">{{__('general.Back')}}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
