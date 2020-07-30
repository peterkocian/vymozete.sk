<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfileRequest;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Show all users from DB in table view.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $result = [];
        try {
            $result = $this->userService->all();
        } catch (\Exception $e) {
            report($e);

            request()->session()->now('fail', $e->getMessage());
        }

        return view('admin.users.index', ['data' => $result]);
    }

    /**
     * Return view form for create new user.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        try {
            $result = $this->userService->getProjection();
        } catch (\Exception $e) {
            report($e);

            //todo dopisat error message - vymysliet standard
            return back()
                ->withFail($e->getMessage());
        }

        return view('admin.users.create', ['user' => $result]);
    }

    /**
     * Store a new user into DB.
     *
     * @return mixed
     */
    public function store()
    {
        $data = request()->all();

        try {
            $result = $this->userService->saveUser($data);
        } catch (ValidationException $e) {
            report($e);

            return back()
                ->withFail(__('general.Create failed'))
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail(__('general.Create failed').PHP_EOL.$e->getMessage())
                ->withInput();
        }

        return redirect()
            ->route('admin.users.show', $result->id)
            ->withSuccess(__('general.Created successfully'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        try {
            $result = $this->find($id);
        } catch (\Exception $e) {
            report($e);

            //todo dopisat error message - vymysliet standard
            return back()
                ->withFail($e->getMessage());
        }

        return view('admin.users.show', ['user' => $result]);
    }

    public function edit($id)
    {
        try {
            $result = $this->find($id);
        } catch (\Exception $e) {
            report($e);

            //todo dopisat error message - vymysliet standard
            return back()
                ->withFail($e->getMessage());
        }

        return view('admin.users.edit', ['user' => $result]);
    }

    public function editProfile($id)
    {
        if(Auth::id() == $id) {
            try {
                $result = $this->find($id);
            } catch (\Exception $e) {
                report($e);

                //todo dopisat error message - vymysliet standard
                return back()
                    ->withFail($e->getMessage());
            }

            return view('admin.users.editProfile', ['user' => $result]);
        }
        return abort(403, __('general.Unauthorized'));
    }

    public function update($id)
    {
        $data = request()->except('_token', '_method');

        try {
            $result = $this->userService->updateUser($data, $id);
        } catch (ValidationException $e) {
            report($e);

            return back()
                ->withFail(__('general.Create failed'))
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail(__('general.Create failed').PHP_EOL.$e->getMessage())
                ->withInput();
        }

        return redirect()
            ->route('admin.users.show', $result->id)
            ->withSuccess(__('general.Created successfully'));
    }

    public function updateProfile(UserProfileRequest $request, $id)
    {
        if(Auth::id() == $id) {
            $data = $request->except('_token', '_method');

            try {
                $result = $this->userService->updateUserProfile($data, $id);
            } catch (\Exception $e) {
                report($e);

                return back()
                    ->withFail(__('general.Create failed') . PHP_EOL . $e->getMessage())
                    ->withInput();
            }

            return redirect()
                ->route('admin.users.editProfile', $result->id)
                ->withSuccess(__('general.Updated successfully'));
        }
        return abort(403, __('general.Unauthorized'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id) {
        try {
            $result = $this->find($id);
        } catch (\Exception $e) {
            report($e);

            //todo dopisat error message - vymysliet standard
            return back()
                ->withFail($e->getMessage());
        }

        if ($result->delete())
        {
            return redirect()
                ->route('admin.users.index')
                ->withSuccess(__('general.Deleted successfully', [
                    'name'      => $result->name,
                    'surname'   => $result->surname,
                    'id'        => $result->id
                ]));
        }
        return back()
            ->withFail(__('general.Delete failed', [
                'name'      => $result->name,
                'surname'   => $result->surname,
                'id'        => $result->id
            ]));
    }

    private function find($id)
    {
        return $this->userService->getProjection()->findOrFail($id);
    }
}
