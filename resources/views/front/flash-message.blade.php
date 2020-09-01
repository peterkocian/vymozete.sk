@if ($message = Session::get('success'))    {{-- green --}}
    <div class="flashMessage">
        {{ $message }}
    </div>
@endif

@if ($message = Session::get('fail'))   {{-- red --}}
    <div class="flashMessage">
        {{ $message }}
    </div>
@endif

@if ($message = Session::get('warning'))    {{-- yellow --}}
    <div class="flashMessage">
        {{ $message }}
    </div>
@endif

@if ($message = Session::get('info'))   {{-- blue --}}
    <div class="flashMessage">
        {{ $message }}
    </div>
@endif
