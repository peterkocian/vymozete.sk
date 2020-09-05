<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\RoleService;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{
    private $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
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
            $result = $this->roleService->getProjection();
        } catch (\Exception $e) {
            report($e);

            //todo dopisat error message - vymysliet standard
            return back()
                ->withFail($e->getMessage());
        }

        return view('admin.roles.create', ['role' => $result]);
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
                ->withFail(__('general.Create failed').PHP_EOL.$e->getMessage())
                ->withInput();
        }

        return redirect()
            ->route('admin.roles.show', $result->id)
            ->withSuccess(__('general.Created successfully'));
    }

    public function show(int $id)
    {
        try {
            $result = $this->find($id);
        } catch (\Exception $e) {
            report($e);

            //todo dopisat error message - vymysliet standard
            return back()
                ->withFail($e->getMessage());
        }

        return view('admin.roles.show', ['role' => $result]);
    }

    public function edit(int $id)
    {
        try {
            $result = $this->find($id);
        } catch (\Exception $e) {
            report($e);

            //todo dopisat error message - vymysliet standard
            return back()
                ->withFail($e->getMessage());
        }

        return view('admin.roles.edit', ['role' => $result]);
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
                ->withFail(__('general.Create failed').PHP_EOL.$e->getMessage())
                ->withInput();
        }

        return redirect()
            ->route('admin.roles.show', $result->id)
            ->withSuccess(__('general.Created successfully'));
    }

    public function destroy(int $id) {
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
                ->route('admin.roles.index')
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
        return $this->roleService->getProjection()->findOrFail($id);
    }
}
