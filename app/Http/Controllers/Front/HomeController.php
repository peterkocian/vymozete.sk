<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\UserProfileFrontRequest;
use App\Repositories\ClaimRepositoryInterface;
use App\Services\LanguageService;
use App\Services\UserService;
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
    private $languageService;
    private $userService;

    public function __construct(
        ClaimRepositoryInterface $claimRepository,
        LanguageService $languageService,
        UserService $userService
    )
    {
        $this->claimRepository = $claimRepository;
        $this->languageService = $languageService;
        $this->userService = $userService;
    }

    public function index() {
        $claims = $this->claimRepository->allByUser(Auth::id());
        return view('front/home', ['claims' => $claims]);
    }

    //todo User model vymenit za Repository
    public function editProfile(int $id)
    {
        if(Auth::id() == $id) {
            try {
                $result = $this->userService->get($id);
                $languages = $this->languageService->all();
            } catch (\Exception $e) {
                report($e);

                //todo dopisat error message - vymysliet standard
                return back()
                    ->withFail($e->getMessage());
            }

            return view('front.user-profile', ['user' => $result, 'languages' => $languages]);
        }
        return abort(403, __('general.Unauthorized'));
    }

    public function updateProfile(UserProfileFrontRequest $request, int $id)
    {
        if(Auth::id() === $id) {
            $data = $request->except('_token', '_method');

            try {
                $result = $this->userService->updateUserProfile($data, $id);
            } catch (\Exception $e) {
                report($e);

                return back()
                    ->withFail(__('general.Create failed') . ' ' . $e->getMessage())
                    ->withInput();
            }

            return back()
                ->withSuccess(__('general.Updated successfully'));
        }
        return abort(403, __('general.Unauthorized'));
    }
}
