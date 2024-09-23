<?php

namespace Database\Seeders;

use App\Models\Settings;
use App\Models\SocialLinks;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SocialLinks::create([
            'social_name' => 'Facebook',
            'social_icon' => 'fab fa-facebook-f',
            'social_link' => 'https://www.facebook.com/',
        ]);
        SocialLinks::create([
            'social_name' => 'Twitter',
            'social_icon' => 'fab fa-twitter',
            'social_link' => 'https://www.twitter.com/',
        ]);
        SocialLinks::create([
            'social_name' => 'Pinterest',
            'social_icon' => 'fab fa-pinterest-p',
            'social_link' => 'https://www.pinterest.com/',
        ]);
        SocialLinks::create([
            'social_name' => 'Instagram',
            'social_icon' => 'fab fa-instagram',
            'social_link' => 'https://www.intstagram.com/',
        ]);

        Settings::create(['address' => '66 broklyn golden street. New York' , 'email' => 'needhelp@company.com',
            'phone' => '+ 1- (246) 333-0089',
            'zoo_map' => 'www.google.com',
            'copyright_text' => '&copy; Copyright by',
            'copyright_year' => date('Y'),
            'copyright_link' => 'Houbarafund.com',
            'copyright_link_name' => 'Houbarafund.com',
            ]);
    }
}
