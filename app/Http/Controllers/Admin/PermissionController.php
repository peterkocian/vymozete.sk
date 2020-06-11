<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all()->toArray();
        return view('admin.permissions.index', ['data' => $permissions]);
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store()
    {
        $validator = $this->validator(request()->all());
        if (!$validator->fails()) {
            $permission = new Permission($validator->validated());

            if ($permission->save()) {
                return redirect()
                    ->route('admin.permissions.show', $permission->id)
                    ->withSuccess(__('general.Created successfully'));
            }
        }
        return back()
            ->withFail(__('general.Create failed'))
            ->withErrors($validator)
            ->withInput();
    }

    public function show($id)
    {
        return view('admin.permissions.show', ['permission' => Permission::findOrFail($id)]);
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', ['permission' => $permission]);
    }

    public function update(Permission $permission)
    {
        $validator = $this->validator(request()->all());
        if (!$validator->fails() && $permission->update($validator->validated())) {
            return redirect()
                ->route('admin.permissions.show', $permission->id)
                ->withSuccess(__('general.Updated successfully'));
        }
        return back()
            ->withFail(__('general.Update failed'))
            ->withErrors($validator)
            ->withInput();
    }

    public function destroy($id) {
        $permission = Permission::findOrFail($id);

        if ($permission->delete()) {
            return redirect()
                ->route('admin.permissions.index')
                ->withSuccess(__('general.Deleted successfully', [
                    'name' => $permission->name,
                    'id' => $permission->id
                ]));
        }
        return back()
            ->withFail(__('general.Delete failed'));
    }

    private function validator(array $all)
    {
        return \Validator::make($all, [
            'name' => 'required|max:191',
//            'slug' => 'required|max:191',    nastavuje mutator
        ]);
    }
}
