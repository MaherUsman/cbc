<?php

namespace App\Services\Frontend;

use App\Models\AboutUs;
use App\Models\AboutUsGallery;
use App\Models\Animal;
use App\Models\Blog;
use App\Models\HomeCounter;
use App\Models\Intro;
use App\Models\Settings;
use App\Models\Slider;
use App\Models\Team;

class HomeService
{
    public function index()
    {
        $data['sliders'] = Slider::all();
        $data['intro'] = Intro::first();
        $data['animals'] = Animal::where('is_homepage' , 'yes')->get();
        $data['amazing_animals'] = Animal::where('is_amazing' , 'yes')->get();
        $data['events'] = Blog::orderBy('start_date' , 'desc')
            ->limit(3)
            ->get();
        $settings = Settings::first();

        $homeCounter = json_decode($settings->home_counter, true);

        $data['homeCounter'] = $homeCounter;
        return $data;
    }
    public function aboutUs()
    {
        $data['aboutUs'] = AboutUs::first();
        $data['teams'] = Team::all();
        $data['galleries'] = AboutUsGallery::all();
        return $data;
    }
}
