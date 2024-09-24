<?php

namespace Database\Seeders;

use App\Models\HomeCounter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

    class HomeCounterSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomeCounter::create(['name' => 'Wild Animals' , 'count' => '60+' , 'icon' => 'flaticon-polar-bear']);
        HomeCounter::create(['name' => 'Aquatic Animals' , 'count' => '20+' , 'icon' => 'flaticon-whale']);
        HomeCounter::create(['name' => 'Happy Visitors' , 'count' => '40+' , 'icon' => 'flaticon-smiling-emoticon-square-face']);
        HomeCounter::create(['name' => 'Beautiful Birds' , 'count' => '60K' , 'icon' => 'flaticon-bird']);
    }
}
