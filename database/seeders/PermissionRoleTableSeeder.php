<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        //['permission_create' ,'permission_edit','permission_show','permission_delete','permission_access','role_create','role_edit','role_show','role_delete','role_access','user_access','user_create','user_edit','user_show','user_delete','channel_access','channel_create','channel_edit','channel_show','channel_delete','compaign_access','compaign_create','compaign_edit','compaign_show','compaign_delete','leads_access','leads_create','leads_edit','leads_show','leads_delete','interaction_access','interaction_create','interaction_edit','interaction_show','interaction_delete','observation_access','observation_create','observation_edit','observation_show','observation_delete'] 


        /*  
            1: SAdmin> Can add, delete any user. AND can view any users (Administrator, vendor, and other roles as well)
            2: Administrator >  Same as SAdmin but Can't assign a user role of Super Admin also can't delete any  user. 
            3: Supervisor > Same as Administrator but Can't delete any user or Campaign, Channel.
            4: Vendedor > Same as Administrator but Can't delete any user or Campaign, Channel. 
        */
        
        $roles = Role::all();

        //Super Admin
        $superAdminPermissions = Permission::pluck('id')->toArray();

        //Administrator
        $administratorPermissions = Permission::whereIn('title',['user_access','user_create','user_edit','user_show','user_delete','channel_access','channel_create','channel_edit','channel_show','channel_delete','compaign_access','compaign_create','compaign_edit','compaign_show','compaign_delete','leads_access','leads_create','leads_edit','leads_show','leads_delete','interaction_access','interaction_create','interaction_edit','interaction_show','interaction_delete','observation_access','observation_create','observation_edit','observation_show','observation_delete'] )->pluck('id')->toArray();

        //Supervior
        $superviorPermissions = Permission::whereIn('title',['user_access','user_create','user_edit','user_show','user_delete','channel_access','channel_create','channel_edit','channel_show','compaign_access','compaign_create','compaign_edit','compaign_show','leads_access','leads_create','leads_edit','leads_show','interaction_access','interaction_create','interaction_edit','interaction_show','interaction_delete','observation_access','observation_create','observation_edit','observation_show'] )->pluck('id')->toArray();

      
        //Vendedor
        $vendedorPermissions = Permission::whereIn('title',['channel_access','channel_create','channel_edit','channel_show','channel_delete','compaign_access','compaign_create','compaign_edit','compaign_show','compaign_delete','leads_access','leads_create','leads_edit','leads_show','leads_delete','interaction_access','interaction_create','interaction_edit','interaction_show','interaction_delete','observation_access','observation_create','observation_edit','observation_show','observation_delete'] )->pluck('id')->toArray();


        foreach ($roles as $role) {
            switch ($role->id) {
                case 1:
                    $role->permissions()->sync($superAdminPermissions);
                    break;
                case 2:
                    $role->permissions()->sync($administratorPermissions);
                    break;
                case 3:
                    $role->permissions()->sync($superviorPermissions);
                    break;
                case 4:
                    $role->permissions()->sync($vendedorPermissions);
                    break;
                default:
                    break;
            }
        }

    }
}
