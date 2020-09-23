<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PermissionService;
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

        return view('admin.permissions.index', ['data' => $result]);
    }

    public function create()
    {
        try {
            $result = $this->permissionService->getProjection();
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail($e->getMessage());
        }

        return view('admin.permissions.create', ['permission' => $result]);
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
            $result = $this->find($id);
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
            $result = $this->find($id);
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail($e->getMessage());
        }

        return view('admin.permissions.edit', ['permission' => $result]);
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

    public function destroy(int $id) {
        try {
            $result = $this->find($id);
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail($e->getMessage());
        }

        if ($result->delete())
        {
            return redirect()
                ->route('admin.permissions.index')
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

    private function find(int $id)
    {
        return $this->permissionService->getProjection()->findOrFail($id);
    }
}
