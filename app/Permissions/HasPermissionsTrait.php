<?php

namespace App\Permissions;

use App\Models\Permission;
use App\Models\Role;

trait HasPermissionsTrait {

    /**
     * Giving Permissions to User
     *
     * @param mixed ...$permissions
     * @return $this
     */
    public function givePermissionsTo(... $permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        if($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    /**
     * Deleting Permissions User's
     *
     * @param mixed ...$permissions
     * @return $this
     */
    public function withdrawPermissionsTo(... $permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    /**
     * @param mixed ...$permissions
     * @return HasPermissionsTrait
     */
    public function refreshPermissions(... $permissions )
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }

    /**
     * Basic function to check, if User has permission
     * It call's two methods
     *
     * @param $permission
     * @return bool
     */
    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    /**
     * Check if User has role
     *
     * @param mixed ...$roles
     * @return bool
     */
    public function hasRole(... $roles )
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get all roles as collection
     *
     * @return Role[]|\Illuminate\Database\Eloquent\Collection
     */
    public function roleList()
    {
        return Role::all();
    }

    /**
     * Get all permissions as collection
     *
     * @return Permission[]|\Illuminate\Database\Eloquent\Collection
     */
    public function permissionList()
    {
        return Permission::all();
    }

    /**
     * Get all User's roles.
     * Nutne aplikovat na user model
     *
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class,'user_has_role');
    }

    /**
     * Get all User's permissions
     * Nutne aplikovat na user model
     *
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'user_has_permission');
    }

    /**
     * Partial function called in hasPermissionTo
     * Check if User has permission through his roles
     * iterating through each permission associated with a role,
     *
     * @param $permission
     * @return bool
     */
    protected function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role){
            if($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Partial function called in hasPermissionTo
     * Check if User has permission
     *
     * @param $permission
     * @return bool
     */
    protected function hasPermission($permission)
    {
        return (bool) $this->permissions->where('slug', $permission->slug)->count();
    }

    /**
     * @param array $permissions
     * @return mixed
     */
    protected function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('slug',$permissions)->get();
    }
}
