<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfileAdminRequest;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
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
     * @return Application|Factory|JsonResponse|View
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

        if (request()->ajax()) {
            return response()->json($result);
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
                ->withFail(__('general.Create failed').' '.$e->getMessage())
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
    public function show(int $id)
    {
        try {
            $result = $this->userService->get($id);
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail($e->getMessage());
        }

        return view('admin.users.show', ['user' => $result]);
    }

    public function edit(int $id)
    {
        try {
            $result = $this->userService->get($id);
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail($e->getMessage());
        }

        return view('admin.users.edit', ['user' => $result]);
    }

    public function editProfile(int $id)
    {
        if(Auth::id() === $id) {
            try {
                $result = $this->userService->get($id);
            } catch (\Exception $e) {
                report($e);

                return back()
                    ->withFail($e->getMessage());
            }

            return view('admin.users.editProfile', ['user' => $result]);
        }
        return abort(Response::HTTP_FORBIDDEN, __('general.Unauthorized'));
    }

    public function update(int $id)
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
                ->withFail(__('general.Create failed').' '.$e->getMessage())
                ->withInput();
        }

        return redirect()
            ->route('admin.users.show', $result->id)
            ->withSuccess(__('general.Created successfully'));
    }

    public function updateProfile(UserProfileAdminRequest $request, int $id)
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

            return redirect()
                ->route('admin.users.editProfile', $result->id)
                ->withSuccess(__('general.Updated successfully'));
        }
        return abort(Response::HTTP_FORBIDDEN, __('general.Unauthorized'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        try {
            $result = $this->userService->destroy($id);

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'id' => $id,
                    'message' => __('general.Deleted successfully'),
                ], Response::HTTP_OK);
            } else {
                return redirect()
                    ->route('admin.users.index')
                    ->withSuccess(__('general.Deleted successfully'));
            }
        } catch (\Exception $e) {
            report($e);

            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'id' => $id,
                    'message' => $e->getMessage(),
                ], $e->getCode() ? $e->getCode() : Response::HTTP_VERSION_NOT_SUPPORTED);
            } else {
                return redirect()
                    ->route('admin.users.index')
                    ->withFail($e->getMessage());
            }
        }
    }

    public function ban(int $id)
    {
        try {
            if ($id) {
                //check if exist
                $user = $this->userService->get($id);

                if ($user->banned) {
                    throw new \Exception('Uzivatel uz je zablokovany.');
                }

                $data['banned'] = 1; //true

                $this->userService->updateUserBan($data, $id);
            }
        } catch (ValidationException $e) {
            report($e);

            return back()
                ->withFail(__('general.Create failed'))
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail(__('general.Create failed').' '.$e->getMessage())
                ->withInput();
        }

        return redirect()
            ->route('admin.users.index')
            ->withSuccess(__('general.Created successfully'));
    }

    public function unBan(int $id)
    {
        try {
            if ($id) {
                //check if exist
                $user = $this->userService->get($id);

                if ($user->banned) {
                    $data['banned'] = 0; //false

                    $this->userService->updateUserBan($data, $id);
                } else {
                    throw new \Exception('Uzivatel uz je odblokovany.');
                }
            }
        } catch (ValidationException $e) {
            report($e);

            return back()
                ->withFail(__('general.Create failed'))
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail(__('general.Create failed').' '.$e->getMessage())
                ->withInput();
        }

        return redirect()
            ->route('admin.users.index')
            ->withSuccess(__('general.Created successfully'));
    }
}
