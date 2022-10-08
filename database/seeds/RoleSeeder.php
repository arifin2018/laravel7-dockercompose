<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $column = [
            'name'  => ''
        ];

        $role = [
            'admin',
            'editor',
            'viewer'
        ];

        $data = array();
        foreach ($column as $key => $value) {
            foreach ($role as $keys => $values) {
                $column[$key] = $role[$keys];
                array_push($data, $column);
            }
        }
        Role::insert($data);
    }
}
