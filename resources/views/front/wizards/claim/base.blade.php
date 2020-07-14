@extends('front.layout')

@section('content')
    <div class="mainbox mainbox_white">
        <div>
            <div>
                @include($getViewPath('steps_bar'))
            </div>

            <form action="{{ $getActionUrl($postAction, [$step->slug()]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                @include($step->view(), compact('step', 'errors'))

                <div class="group">
                    <div class="row">
                        @if ($stepRepo->hasNext())
                            <button type="submit" class="big_btn">
                                @lang('front/form-wizard.next')
                            </button>
                        @else
                            <button type="submit" class="big_btn">
                                @lang('front/form-wizard.done')
                            </button>
                        @endif
                    </div>

                    <div class="row">
                        @if ($stepRepo->hasPrev())
                            <button class="switch-step without-bckg" onclick="this.form.action = '{{ $getActionUrl($postAction, [$step->slug(), '_trigger' => 'back']) }}'; this.form.submit();">
                                @lang('front/form-wizard.back')
                            </button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
