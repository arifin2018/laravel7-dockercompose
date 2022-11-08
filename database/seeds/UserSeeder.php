<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 30)->create();
        /*
        $data = [
            [
                'nur',
                'azriel',
                'azrielrafiq@lenna.ai',
                '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password,
                Role::inRandomOrder()->first()->id
            ],
            [
                'rafiq',
                'pradipta',
                'rafiq@lenna.ai',
                '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
                Role::inRandomOrder()->first()->id
            ],
        ];
        $column = [
            'first_name'    => '',
            'last_name' => '',
            'email' => '',
            'password' => '',
            'role_id' => ''
        ];
        $resultData = [];

        $i = 0;
        foreach ($data as $key => $value) {
            foreach ($column as $keys => $values) {
                $column[$keys] = $data[$key][$i];
                $i++;
            }
            $resultData[] = $column;
            $i = 0;
        }

        while ($resultData) {
            User::create($resultData[$i]);
            unset($resultData[$i]);
            $i++;
        }
        */
    }
}
