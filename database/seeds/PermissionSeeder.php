<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'view_users',
            'edit_users',
            'view_roles',
            'edit_roles',
            'view_product',
            'edit_product',
            'view_orders',
            'edit_orders',
        ];

        foreach ($data as $key => $value) {
            Permission::insert([
                'name'  => $value
            ]);
        }
    }
}
