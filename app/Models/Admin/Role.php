<?php

namespace App\Models\Admin;

use App\Permissions\HasPermissionsTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasPermissionsTrait;

    private $table = 'role';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'role_has_permission');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'user_has_role');
    }
}
