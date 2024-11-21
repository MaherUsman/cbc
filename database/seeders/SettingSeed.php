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
    public function run()
    {
        $links = [
            [
                'social_name' => 'Facebook',
                'social_icon' => 'fab fa-facebook-f',
                'social_link' => 'https://www.facebook.com/houbara',
            ],
            [
                'social_name' => 'Twitter',
                'social_icon' => 'fab fa-twitter',
                'social_link' => 'https://www.twitter.com/',
            ],
            [
                'social_name' => 'Youtube',
                'social_icon' => 'fab fa-youtube',
                'social_link' => 'https://www.youtube.com/@houbarafoundationinternati5340',
            ],
            [
                'social_name' => 'Instagram',
                'social_icon' => 'fab fa-instagram',
                'social_link' => 'https://www.instagram.com/hfip_216/',
            ],
        ];

        foreach ($links as $link) {
            SocialLinks::updateOrCreate(
                ['social_name' => $link['social_name']], // Search criteria
                [
                    'social_icon' => $link['social_icon'],
                    'social_link' => $link['social_link'],
                ] // Data to update or insert
            );
        }

        $setting = [
            'address' => '66 broklyn golden street. New York',
            'email' => 'hfipscs@gmail.com',
            'phone' => '+ 1- (246) 333-0089',
            'zoo_map' => 'www.google.com',
            'copyright_text' => '&copy; Copyright by',
            'copyright_year' => date('Y'),
            'copyright_link' => 'Houbarafund.com',
            'copyright_link_name' => 'Houbarafund.com',
        ];
        $settings = Settings::first();

        if ($settings) {
            $settings->update($setting);
        } else {
            Settings::create($setting);
        }
    }
}
