@if ($message = Session::get('success'))    {{-- green --}}
    <flash
        :message="{{ json_encode(['text' => $message, 'type' => 'success', 'timer' => 3000]) }}"
    ></flash>
@endif

@if ($message = Session::get('fail'))   {{-- red --}}
    <flash
        :message="{{ json_encode(['text' => $message, 'type' => 'error', 'timer' => null]) }}"
    ></flash>
@endif

@if ($message = Session::get('warning'))    {{-- yellow --}}
    <flash
        :message="{{ json_encode(['text' => $message, 'type' => 'warning', 'timer' => null]) }}"
    ></flash>
@endif

@if ($message = Session::get('info'))   {{-- blue --}}
    <flash
        :message="{{ json_encode(['text' => $message, 'type' => 'info', 'timer' => null]) }}"
    ></flash>
@endif

<flash></flash> {{-- musi tu byt komponenta pre ajaxove responsy--}}
