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

            if(Request::is('admin/*')){
                return redirect()
                    ->route('admin.loginForm')
                    ->withInput()
                    ->withFail('Smola, si zabanovany');
            } else {
                return redirect()
                    ->route('login')
                    ->withInput()
                    ->withFail('Smola, si zabanovany');
            }
        }

        return $next($request);
    }
}
