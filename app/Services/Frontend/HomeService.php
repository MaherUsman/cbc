<?php

namespace App\Services\Frontend;

use App\Models\Intro;
use App\Models\Slider;

class HomeService
{
    public function index()
    {
        $data['sliders'] = Slider::all();
        $data['intro'] = Intro::first();
        return $data;
    }
}
