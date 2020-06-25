@extends('front.layout')

@section('content')
    <div class="mainbox mainbox_white">
        <div class="col-md-8">
            <div class="mb-3">
                @include($getViewPath('steps_bar'))
            </div>

            <form action="{{ $getActionUrl($postAction, [$step->slug()]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                @include($step->view(), compact('step', 'errors'))

                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        @if ($stepRepo->hasPrev())
                            <button type="button" class="btn btn-primary big_btn" onclick="this.form.action = '{{ $getActionUrl($postAction, [$step->slug(), '_trigger' => 'back']) }}'; this.form.submit();">
                                @lang('wizard::generic.back')
                            </button>
                        @endif
                    </div>

                    <div class="ml-auto">
                        @if ($stepRepo->hasNext())
                            <button type="submit" class="btn btn-primary big_btn">
                                @lang('wizard::generic.next')
                            </button>
                        @else
                            <button type="submit" class="btn btn-primary big_btn">
                                @lang('wizard::generic.done')
                            </button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
