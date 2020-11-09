<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
    protected $redirectTo = RouteServiceProvider::BACKEND_HOME;

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
     * Log the user out from backoffice.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request){
        $this->performLogout($request);
        return redirect()
            ->route('admin.login')
            ->with('success',__('general.User has been logged out!'));
    }

    /**
     * When user is authenticated, than logout other devices
     *
     * @param Request $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $request->session()->flash('success',__('general.User has been logged in!'));
        Auth::logoutOtherDevices($request->get('password'));
    }
}
