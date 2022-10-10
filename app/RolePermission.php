<?php

namespace App;

use App\Role;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $guarded = ['id'];

    public function permissions()
    {
        return $this->belongsTo(Permission::class, 'permission_id', 'id');
    }
}
