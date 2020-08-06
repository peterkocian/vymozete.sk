<?php

namespace App\Http\Controllers\Front;

use App\Repositories\ClaimRepositoryInterface;
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

    private $claimRepository;

    public function __construct(ClaimRepositoryInterface $claimRepository)
    {
        $this->claimRepository = $claimRepository;
    }

    public function index() {
        $claims = $this->claimRepository->allByUser(Auth::id());
        return view('front/home', ['claims' => $claims]);
    }

    //todo User model vymenit za Repository
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
