<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\PermissionRepositoryInterface;
use App\Services\RoleService;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{
    private $roleService;
    private $permissionRepository;

    public function __construct(
        RoleService $roleService,
        PermissionRepositoryInterface $permissionRepository
    )
    {
        $this->roleService = $roleService;
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        $result = [];
        try {
            $result = $this->roleService->all();
        } catch (\Exception $e) {
            report($e);

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
            $permissions = $this->permissionRepository->all();
        } catch (\Exception $e) {
            report($e);
            return back()
                ->withFail($e->getMessage());
        }

        $data = [
            'permissionList' => $permissions,
        ];

        return view('admin.roles.create', ['data' => $data]);
    }

    /**
     * Store a new role.
     *
     * @return Response
     */
    public function store()
    {
        $data = request()->all();

        try {
            $result = $this->roleService->saveRole($data);
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
            ->route('admin.roles.show', $result->id)
            ->withSuccess(__('general.Created successfully'));
    }

    public function show(int $id)
    {
        try {
            $result = $this->roleService->get($id);
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail($e->getMessage());
        }

        return view('admin.roles.show', ['role' => $result]);
    }

    public function edit(int $id)
    {
        try {
            $data = $this->roleService->get($id);
            $permissions = $this->permissionRepository->all();
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail($e->getMessage());
        }
        $data['permissionList'] = $permissions;

        return view('admin.roles.edit', ['data' => $data]);
    }

    public function update(int $id)
    {
        $data = request()->except('_token', '_method');

        try {
            $result = $this->roleService->updateRole($data, $id);
        } catch (ValidationException $e) {
            report($e);

            return back()
                ->withFail(__('general.Create failed'))
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail(__('general.Create failed'). ' ' .$e->getMessage())
                ->withInput();
        }

        return redirect()
            ->route('admin.roles.show', $result->id)
            ->withSuccess(__('general.Created successfully'));
    }

    public function destroy(int $id)
    {
        try {
            $result = $this->roleService->destroy($id);

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
            report($e);

            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'id' => $id,
                    'message' => $e->getMessage(),
                ], $e->getCode() ? $e->getCode() : Response::HTTP_VERSION_NOT_SUPPORTED);
            } else {
                return redirect()
                    ->route('admin.roles.index')
                    ->withFail(__('general.Delete failed'));
            }
        }
    }
}
