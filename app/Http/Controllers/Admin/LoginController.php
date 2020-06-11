<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers {
        logout as performLogout;
        login as performLogin;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Show the backoffice application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function passwordReset()
    {
        return view('admin.passwords.email');
    }

    /**
     * Handle a login request to the backoffice application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->performLogin($request);
        return redirect()
            ->route('admin.home')
            ->with('success','User has been logged in!');
    }

    /**
     * Log the user out from backoffice.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request){
        $this->performLogout($request);
        return redirect()
            ->route('admin.login')
            ->with('status','User has been logged out!');
    }
}
