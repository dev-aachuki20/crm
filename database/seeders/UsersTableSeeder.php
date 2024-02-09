<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'first_name'     => 'Super',
                'last_name'      => 'Admin',
                'name'           => 'Super Admin',
                'username'       => 'superadmin',
                'email'          => 'superadmin@gmail.com',
                'birthDate'      => '2000-07-19',
                'password'       =>  Hash::make('Admin@123'),
                'remember_token' => null,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            
            [
                'id'             => 2,
                'first_name'     => 'Administrador',
                'last_name'      => null,
                'name'           => 'Administrador',
                'username'       => 'administrador',
                'email'          => 'administrador@gmail.com',
                'birthDate'      => '2000-07-19',
                'password'       =>  Hash::make('Administr@12'),
                'remember_token' => null,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'id'             => 3,
                'first_name'     => 'Vendor',
                'last_name'      => null,
                'name'           => 'Vendor',
                'username'       => 'vendor',
                'email'          => 'vendor@gmail.com',
                'birthDate'      => '2000-07-19',
                'password'       =>  Hash::make('Vendor@123'),
                'remember_token' => null,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],

            [
                'id'             => 4,
                'first_name'     => 'Supervisor',
                'last_name'      => null,
                'name'           => 'Supervisor',
                'username'       => 'supervisor',
                'email'          => 'supervisor@gmail.com',
                'birthDate'      => '2000-07-19',
                'password'       =>  Hash::make('Supervisor@1'),
                'remember_token' => null,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
        ];
        User::insert($users);
    }
}
