<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PermissionService;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class PermissionController extends Controller
{
    private $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index()
    {
        $result = [];
        try {
            $result = $this->permissionService->all();
        } catch (\Exception $e) {
            report($e);

            request()->session()->now('fail', $e->getMessage());
        }

        if (request()->ajax()) {
            return response()->json($result);
        }

        return view('admin.permissions.index', ['data' => $result]);
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a new user.
     *
     * @return
     */
    public function store()
    {
        $data = request()->all();

        try {
            $result = $this->permissionService->savePermission($data);
        } catch (ValidationException $e) {
            report($e);

            return back()
                ->withFail(__('general.Create failed'))
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail(__('general.Create failed') . ' ' . $e->getMessage())
                ->withInput();
        }

        return redirect()
            ->route('admin.permissions.show', $result->id)
            ->withSuccess(__('general.Created successfully'));
    }

    public function show(int $id)
    {
        try {
            $result = $this->permissionService->get($id);
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail($e->getMessage());
        }

        return view('admin.permissions.show', ['permission' => $result]);
    }

    public function edit(int $id)
    {
        try {
            $data = $this->permissionService->get($id);
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail($e->getMessage());
        }

        return view('admin.permissions.edit', ['data' => $data]);
    }

    public function update(int $id)
    {
        $data = request()->except('_token', '_method');

        try {
            $result = $this->permissionService->updatePermission($data, $id);
        } catch (ValidationException $e) {
            report($e);

            return back()
                ->withFail(__('general.Create failed'))
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail(__('general.Create failed') . ' ' . $e->getMessage())
                ->withInput();
        }

        return redirect()
            ->route('admin.permissions.show', $result->id)
            ->withSuccess(__('general.Created successfully'));
    }

    public function destroy(int $id)
    {
        try {
            $result = $this->permissionService->destroy($id);

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'id' => $id,
                    'message' => __('general.Deleted successfully'),
                ], Response::HTTP_OK);
            } else {
                return redirect()
                    ->route('admin.permissions.index')
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
                    ->route('admin.permissions.index')
                    ->withFail($e->getMessage());
            }
        }
    }
}
