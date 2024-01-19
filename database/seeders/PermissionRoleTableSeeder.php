<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $all_permissions = Permission::all();

        //Super Admin
        $superAdminPermissions = $all_permissions->filter(function ($permission) {
            return $permission;
        });

        Role::findOrFail(1)->permissions()->sync($superAdminPermissions->pluck('id'));

        //Administrator
        $administratorPermissions = $all_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 11) != 'permission_' && substr($permission->title, 0, 5) != 'role_'  && substr($permission->title, 0, 8) != 'channel_' && substr($permission->title, 0, 5) != 'user_'  && substr($permission->title, 0, 9) != 'compaign_'  && substr($permission->title, 0, 6) != 'leads_'  && substr($permission->title, 0, 12) != 'interaction_'  && substr($permission->title, 0, 12) != 'observation_' && substr($permission->title, 0, 5) != 'task_';
        });

        Role::findOrFail(2)->permissions()->sync($administratorPermissions);

        //Vendedor
        $vendedorPermissions = $all_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 11) != 'permission_' && substr($permission->title, 0, 5) != 'role_'  && substr($permission->title, 0, 8) != 'channel_' && substr($permission->title, 0, 5) != 'user_'  && substr($permission->title, 0, 9) != 'compaign_'  && substr($permission->title, 0, 6) != 'leads_'  && substr($permission->title, 0, 12) != 'interaction_'  && substr($permission->title, 0, 12) != 'observation_' && substr($permission->title, 0, 5) != 'task_';
        });

        Role::findOrFail(3)->permissions()->sync($vendedorPermissions);

        //Supervior
        $superviorPermissions = $all_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 11) != 'permission_' && substr($permission->title, 0, 5) != 'role_'  && substr($permission->title, 0, 8) != 'channel_' && substr($permission->title, 0, 5) != 'user_'  && substr($permission->title, 0, 9) != 'compaign_'  && substr($permission->title, 0, 6) != 'leads_'  && substr($permission->title, 0, 12) != 'interaction_'  && substr($permission->title, 0, 12) != 'observation_' && substr($permission->title, 0, 5) != 'task_';
        });

        Role::findOrFail(4)->permissions()->sync($superviorPermissions);

    }
}
