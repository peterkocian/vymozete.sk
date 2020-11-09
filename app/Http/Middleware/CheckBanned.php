<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->banned) {
            auth()->logout();

            if(Request::is('admin*')){
                return redirect()
                    ->route('admin.loginForm')
                    ->withInput()
                    ->withFail(__('auth.user banned'));
            } else {
                return redirect()
                    ->route('login')
                    ->withInput()
                    ->withFail(__('auth.user banned'));
            }
        }

        return $next($request);
    }
}
