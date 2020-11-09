<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\Language;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use App\Rules\EmailMustHaveTLD;
use App\Rules\StrongPassword;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::FRONTEND_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email'     => ['required','string', 'email', 'max:255', new EmailMustHaveTLD, 'unique:users,email,'],
            'password'  => ['required','confirmed',new StrongPassword()],
            'phone'     => ['regex:/\+\d{12}/u', 'nullable'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $language = Language::where('default', 1)->firstOrFail();
        $public_user_role = Role::where('slug', User::PUBLIC_USER_DEFAULT_ROLE)->firstOrFail();

        $user = User::create([
//            'name' => $data['name'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
            'phone'     => $data['phone'],
            'language_id' => $language->id,
        ]);

        if ($user) {
            $user->roles()->sync($public_user_role->id);
        }

        Mail::to($data['email'])->send(new WelcomeMail($user));

        return $user;
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    protected function registered(Request $request, $user)
    {
        $request->session()->flash('success','Vitajte, registrácia bola úspešná.');
    }
}
