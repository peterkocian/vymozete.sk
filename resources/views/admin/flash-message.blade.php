@if ($message = Session::get('success'))    {{-- green --}}
{{--    <div class="alert alert-success alert-block fade show">--}}
{{--        <button type="button" class="close" data-dismiss="alert">×</button>--}}
{{--        {{ $message }}--}}
{{--    </div>--}}
    <flash
        :message="{{ json_encode(['text' => $message, 'type' => 'success', 'timer' => null]) }}"
    ></flash>
@endif

@if ($message = Session::get('fail'))   {{-- red --}}
{{--    <div class="alert alert-danger alert-block">--}}
{{--        <button type="button" class="close" data-dismiss="alert">×</button>--}}
{{--        {{ $message }}--}}
{{--    </div>--}}
    <flash
        :message="{{ json_encode(['text' => $message, 'type' => 'error', 'timer' => null]) }}"
    ></flash>
@endif

@if ($message = Session::get('warning'))    {{-- yellow --}}
{{--    <div class="alert alert-warning alert-block">--}}
{{--        <button type="button" class="close" data-dismiss="alert">×</button>--}}
{{--        {{ $message }}--}}
{{--    </div>--}}
    <flash
        :message="{{ json_encode(['text' => $message, 'type' => 'warning', 'timer' => null]) }}"
    ></flash>
@endif

@if ($message = Session::get('info'))   {{-- blue --}}
{{--    <div class="alert alert-info alert-block">--}}
{{--        <button type="button" class="close" data-dismiss="alert">×</button>--}}
{{--        {{ $message }}--}}
{{--    </div>--}}
    <flash
        :message="{{ json_encode(['text' => $message, 'type' => 'info', 'timer' => null]) }}"
    ></flash>
@endif
