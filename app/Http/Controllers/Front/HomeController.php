<?php

namespace App\Http\Controllers\Front;

use App\Models\Front\Claim;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index() {
        return view('front/home', ['claims' => Claim::all()]);
    }

    public function editProfile(User $user)
    {
        if(Auth::id() == $user->id) {
            return view('front.user-profile', ['user' => $user]);
        }
        return abort(403, __('general.Unauthorized'));
    }
}
