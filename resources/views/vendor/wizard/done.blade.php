@extends('front.layout')

@section('content')
    <div class="mainbox mainbox_white">
        <div class="container my-3">
            <h1 class="text-center">
                {{ __($doneText ?? 'wizard::generic.done') }}
            </h1>
        </div>
    </div>
@endsection
