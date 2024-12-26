<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::where('email','admin@gmail.com')->delete();
        User::where('email','test_manager01@gmail.com')->delete();
        User::where('email','test_user01@gmail.com')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $user = User::create(['first_name' => 'Admin' , 'last_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => '11223344',//Hash::make(11223344),
            'phone' => '03xx0xxxxx',
        ]);
        $user->addRole('admin');

        $user = User::create(['first_name' => 'Testing' , 'last_name' => 'Manager',
            'email' => 'test_manager01@gmail.com',
            'username' => 'test-manager',
            'password' => '11223344',//Hash::make(11223344),
            'phone' => '03xx0xxxxx',
        ]);
        $user->addRole('manager');

        $user = User::create(['first_name' => 'Test' , 'last_name' => 'User',
            'email' => 'test_user01@gmail.com',
            'username' => 'test-user',
            'password' => '11223344',//Hash::make(11223344),
            'phone' => '03xx0xxxxx',
        ]);
        $user->addRole('user');
    }
}
