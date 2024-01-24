<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'language_id'    => 1,
                'first_name'     => 'Super',
                'last_name'      => 'Admin',
                'name'           => 'Super Admin',
                'username'       => 'admin123',
                'email'          => 'dev@gmail.com',
                'birthDate'      => '2000-07-19',
                'password'       => bcrypt('12345678'),
                'remember_token' => null,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'id'             => 2,
                'language_id'    => 1,
                'first_name'     => 'Supervisor',
                'last_name'      => null,
                'name'           => 'Supervisor',
                'username'       => 'supervisor123',
                'email'          => 'supervisor123@gmail.com',
                'birthDate'      => '2000-07-19',
                'password'       => bcrypt('12345678'),
                'remember_token' => null,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'id'             => 3,
                'language_id'    => 1,
                'first_name'     => 'Administrador',
                'last_name'      => null,
                'name'           => 'Administrador',
                'username'       => 'administrador123',
                'email'          => 'administrador@gmail.com',
                'birthDate'      => '2000-07-19',
                'password'       => bcrypt('12345678'),
                'remember_token' => null,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'id'             => 4,
                'language_id'    => 1,
                'first_name'     => 'Vendor',
                'last_name'      => null,
                'name'           => 'Vendor',
                'username'       => 'vendor123',
                'email'          => 'vendor@gmail.com',
                'birthDate'      => '2000-07-19',
                'password'       => bcrypt('12345678'),
                'remember_token' => null,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
        ];
        User::insert($users);
    }
}
