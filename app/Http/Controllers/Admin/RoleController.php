<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all()->toArray();
        return view ('admin.roles.index', ['data' => $roles]);
    }

    public function create()
    {
        $role = new Role();
        return view('admin.roles.create', ['role' => $role]);
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
            $role = new Role($validator->validated());

            if ($role->save()) {
                $role->permissions()->sync(request('permissions'));
                return redirect()
                    ->route('admin.roles.show', $role->id)
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
        return view('admin.roles.show', ['role' => Role::findOrFail($id)]);
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', ['role' => $role]);
    }

    public function update(Role $role)
    {
        $validator = $this->validator(request()->all());
        if (!$validator->fails() && $role->update($validator->validated())) {
            $role->permissions()->sync(request('permissions'));
            return redirect()
                ->route('admin.roles.show', $role->id)
                ->withSuccess(__('general.Updated successfully'));
        }
        return back()
            ->withFail(__('general.Update failed'))
            ->withErrors($validator)
            ->withInput();
    }

    public function destroy($id) {
        $role = Role::findOrFail($id);

        if ($role->delete()) {
            return redirect()
                ->route('admin.roles.index')
                ->withSuccess(__('general.Deleted successfully', [
                    'name' => $role->name,
                    'id' => $role->id
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
