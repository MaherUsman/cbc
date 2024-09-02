<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeds extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Permission::truncate();
        app()['cache']->forget('spatie.permission.cache');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Permission::create(['name' => 'view.jobs']);
        Permission::create(['name' => 'create.jobs']);
        Permission::create(['name' => 'update.jobs']);
        Permission::create(['name' => 'destroy.jobs']);
    }
}
