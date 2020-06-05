<?php

namespace App\Models\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    private $table = 'permission';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_has_permission');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'user_has_permission');
    }
}
