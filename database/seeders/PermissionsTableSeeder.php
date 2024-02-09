<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $updateDate = $createDate = date('Y-m-d H:i:s');
        $permissions = [
            [
                'title'      => 'permission_create',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'permission_edit',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'permission_show',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'permission_delete',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'permission_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'role_create',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'role_edit',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'role_show',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'role_delete',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'role_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'user_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'user_create',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'user_edit',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'user_show',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'user_delete',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],

           
            [
                'title'      => 'channel_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'channel_create',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'channel_edit',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'channel_show',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'channel_delete',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],

            [
                'title'      => 'compaign_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'compaign_create',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'compaign_edit',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'compaign_show',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'compaign_delete',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],

            [
                'title'      => 'leads_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'leads_create',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'leads_edit',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'leads_show',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'leads_delete',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],

            [
                'title'      => 'interaction_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'interaction_create',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'interaction_edit',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'interaction_show',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'interaction_delete',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],


            [
                'title'      => 'observation_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'observation_create',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'observation_edit',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'observation_show',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'observation_delete',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],

        ];

        Permission::insert($permissions);
    }
}
