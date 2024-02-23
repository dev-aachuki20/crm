<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $update_at = $created_at = date('Y-m-d H:i:s');
        $roles = [
            [
                'id'         => 1,
                'title'      => 'Super Admin',
                'created_at' => $created_at,
                'updated_at' => $update_at,
            ], 
            [
                'id'         => 2,
                'title'      => 'Administrator',
                'created_at' => $created_at,
                'updated_at' => $update_at,
            ],
            [
                'id'         => 3,
                'title'      => 'Supervisor',
                'created_at' => $created_at,
                'updated_at' => $update_at,
            ],
            [
                'id'         => 4,
                'title'      => 'Vendor',
                'created_at' => $created_at,
                'updated_at' => $update_at,
            ],           
        ];

        Role::insert($roles);
    }
}
