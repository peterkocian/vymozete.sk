<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserProfileAdminRequest;
use App\Services\PermissionService;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    private $userService;
    private $roleService;
    private $permissionService;

    public function __construct(
        UserService $userService,
        RoleService $roleService,
        PermissionService $permissionService,
    )
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
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
            $roleList = $this->roleService->getDataForSelectbox();
            $permissionList = $this->permissionService->getDataForSelectbox();
        } catch (\Exception $e) {
            return back()
                ->withFail($e->getMessage());
        }

        $data = [
            'roleList' => $roleList,
            'permissionList' => $permissionList,
        ];

        return view('admin.users.create', ['data' => $data]);
    }

    /**
     * Store a new user into DB.
     *
     * @param StoreUserRequest $request
     * @return mixed
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        try {
            $result = $this->userService->saveUser($data);
        } catch (\Exception $e) {
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
            return back()
                ->withFail($e->getMessage());
        }

        return view('admin.users.show', ['user' => $result]);
    }

    public function edit(int $id)
    {
        try {
            $data = $this->userService->get($id);
            $roleList = $this->roleService->getDataForSelectbox();
            $permissionList = $this->permissionService->getDataForSelectbox();
        } catch (\Exception $e) {
            return back()
                ->withFail($e->getMessage());
        }

        $data['roleList'] = $roleList;
        $data['permissionList'] = $permissionList;

        return view('admin.users.edit', ['data' => $data]);
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

    public function update(UpdateUserRequest $request, int $id)
    {
        $data = $request->validated();

        try {
            $result = $this->userService->updateUser($data, $id);
        } catch (\Exception $e) {
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
            $data = $request->validated();

            try {
                $result = $this->userService->updateUserProfile($data, $id);
            } catch (\Exception $e) {
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
            $this->userService->destroy($id);

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
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'id' => $id,
                    'message' => $e->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
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
            $this->userService->updateUserBan($id, 'ban');

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'id' => $id,
                    'message' => __('general.Banned successfully'),
                ], Response::HTTP_OK);
            } else {
                return redirect()
                    ->route('admin.users.index')
                    ->withSuccess(__('general.Banned successfully'));
            }
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'id' => $id,
                    'message' => __('general.Ban failed').' '.$e->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                return redirect()
                    ->route('admin.users.index')
                    ->withFail(__('general.Ban failed').' '.$e->getMessage());
            }
        }
    }

    public function unban(int $id)
    {
        try {
            $this->userService->updateUserBan($id, 'unban');

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'id' => $id,
                    'message' => __('general.Unbanned successfully'),
                ], Response::HTTP_OK);
            } else {
                return redirect()
                    ->route('admin.users.index')
                    ->withSuccess(__('general.Unbanned successfully'));
            }
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'id' => $id,
                    'message' => __('general.Unban failed').' '.$e->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                return redirect()
                    ->route('admin.users.index')
                    ->withFail(__('general.Unban failed').' '.$e->getMessage());
            }
        }
    }
}
