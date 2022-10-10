<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = ['id'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, RolePermission::class,);
    }

    public function role_permissions()
    {
        return $this->hasMany(RolePermission::class, 'role_id', 'id');
    }
}
