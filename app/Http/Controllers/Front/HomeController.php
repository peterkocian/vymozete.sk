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
        return view('front/home', ['claims' => Claim::all()->where('user_id', Auth::id())]);
    }

    public function editProfile(User $user)
    {
        if(Auth::id() == $user->id) {
            return view('front.user-profile', ['user' => $user]);
        }
        return abort(403, __('general.Unauthorized'));
    }

    public function updateProfile(User $user)
    {
        $validator = $this->validator(request()->all());
        if (!$validator->fails())
        {
            $user->name     = request('name');
            $user->surname  = request('surname');

            if ($user->update()) {
                return redirect()
                    ->route('front.users.editProfile', $user->id)
                    ->withSuccess(__('general.Updated successfully'));
            }
        }
        return back()
            ->withFail(__('general.Update failed'))
            ->withErrors($validator)
            ->withInput();
    }

    private function validator(array $all, $id = null)
    {
        return \Validator::make($all, [
            'name'      => 'required|max:191',
            'surname'   => 'required|max:191',
            'email'     => 'nullable|email|unique:users,email,'.$id
        ]);
    }
}
