<?php

namespace App\Services\Frontend;

use App\Models\Animal;
use App\Models\Blog;
use App\Models\Intro;
use App\Models\Slider;

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
        return $data;
    }
}
