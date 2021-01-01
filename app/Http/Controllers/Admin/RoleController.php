<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    private $roleService;
    private $permissionService;

    public function __construct(
        RoleService $roleService,
        PermissionService $permissionService
    )
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    public function index()
    {
        $result = [];
        try {
            $result = $this->roleService->all();
        } catch (\Exception $e) {
            request()->session()->now('fail', $e->getMessage());
        }

        if (request()->ajax()) {
            return response()->json($result);
        }

        return view('admin.roles.index', ['data' => $result]);
    }

    public function create()
    {
        try {
            $permissionList = $this->permissionService->getDataForSelectbox();
        } catch (\Exception $e) {
            return back()
                ->withFail($e->getMessage());
        }

        $data = [
            'permissionList' => $permissionList,
        ];

        return view('admin.roles.create', ['data' => $data]);
    }

    /**
     * Store a new role.
     *
     * @param StoreRoleRequest $request
     * @return Response
     */
    public function store(StoreRoleRequest $request)
    {
        $data = $request->validated();

        try {
            $result = $this->roleService->saveRole($data);
        } catch (\Exception $e) {
            return back()
                ->withFail(__('general.Create failed').' '.$e->getMessage())
                ->withInput();
        }

        return redirect()
            ->route('admin.roles.show', $result->id)
            ->withSuccess(__('general.Created successfully'));
    }

    public function show(int $id)
    {
        try {
            $result = $this->roleService->get($id);
        } catch (\Exception $e) {
            return back()
                ->withFail($e->getMessage());
        }

        return view('admin.roles.show', ['role' => $result]);
    }

    public function edit(int $id)
    {
        try {
            $data = $this->roleService->get($id);
            $permissionList = $this->permissionService->getDataForSelectbox();
        } catch (\Exception $e) {
            return back()
                ->withFail($e->getMessage());
        }
        $data['permissionList'] = $permissionList;

        return view('admin.roles.edit', ['data' => $data]);
    }

    public function update(StoreRoleRequest $request, int $id)
    {
        $data = $request->validated();

        try {
            $result = $this->roleService->updateRole($data, $id);
        } catch (\Exception $e) {
            return back()
                ->withFail(__('general.Update failed'). ' ' .$e->getMessage())
                ->withInput();
        }

        return redirect()
            ->route('admin.roles.show', $result->id)
            ->withSuccess(__('general.Updated successfully'));
    }

    public function destroy(int $id)
    {
        try {
            $this->roleService->destroy($id);

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'id' => $id,
                    'message' => __('general.Deleted successfully'),
                ], Response::HTTP_OK);
            } else {
                return redirect()
                    ->route('admin.roles.index')
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
                    ->route('admin.roles.index')
                    ->withFail(__('general.Delete failed'));
            }
        }
    }
}
