<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laratrust\Models\Permission;
use Laratrust\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Retrieve the admin role
        $adminRole = Role::where('name', 'admin')->first();

        // Retrieve all permissions
        $permissions = Permission::all()->pluck('id');

        // Assign all permissions to the admin role
        /*foreach ($permissions as $permission) {
            $adminRole->attachPermission($permission);
        }*/

        // Alternatively, you can use the syncPermissions method (it removes existing permissions and adds new ones):
        //$adminRole->syncPermissions($permissions);
        //$adminRole->syncPermissions($permissions);
        $adminRole->permissions()->sync($permissions);
        // Optionally, assign the admin role to a user (if needed)
        // $user = User::find(1); // Replace with actual user ID
        // $user->attachRole($adminRole);
    }
}
