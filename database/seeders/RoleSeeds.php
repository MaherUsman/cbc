<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeds extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $roles = [
            ['name'=>'admin','display_name'=>'Admin'],
            ['name'=>'manager','display_name'=>'Manager'],
            ['name'=>'user','display_name'=>'User'],
        ];
        Role::insert($roles);
    }
}
