<?php

use App\Permission;
use App\Role;
use App\RolePermission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();
        $admin = Role::where('name', 'admin')->first();

        foreach ($permissions as $key => $value) {
            RolePermission::create([
                'role_id'       => $admin->id,
                'permission_id' => $value->id
            ]);
        }

        $editor = Role::where('name', 'editor')->first();

        foreach ($permissions as $key => $value) {
            if ($value->name != 'edit_roles') {
                RolePermission::create([
                    'role_id'       => $editor->id,
                    'permission_id' => $value->id
                ]);
            }
        }

        $viewer = Role::where('name', 'viewer')->first();

        $rolesDeny = [
            'view_users',
            'view_roles',
            'view_product',
            'view_orders'
        ];
        foreach ($permissions as $key => $value) {
            if (in_array($value->name, $rolesDeny)) {
                RolePermission::create([
                    'role_id'       => $viewer->id,
                    'permission_id' => $value->id
                ]);
            }
        }
    }
}
