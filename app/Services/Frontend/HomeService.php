<?php

namespace App\Services\Frontend;

use App\Models\AboutUs;
use App\Models\AboutUsGallery;
use App\Models\Animal;
use App\Models\Blog;
use App\Models\HomeCounter;
use App\Models\Intro;
use App\Models\ResearchArticle;
use App\Models\Security;
use App\Models\Settings;
use App\Models\Slider;
use App\Models\Team;
use App\Models\HomepageSection;

class HomeService
{
    public function index()
    {
        $data['sliders'] = Slider::all();
        $data['intro'] = Intro::first();
        $data['animals'] = Animal::where('show_on_top_bar' , '1')
            ->orderBy('display_order' , 'ASC')
            ->get();
        $data['amazing_animals'] = Animal::where('is_amazing' , 'yes')->get();
        $data['events'] = Blog::orderBy('start_date' , 'desc')
            ->limit(3)
            ->get();
        $settings = Settings::first();

        $homeCounter = json_decode($settings->home_counter, true);

        $data['homeCounter'] = $homeCounter;
        $data['homepageSection'] = HomepageSection::first();
        return $data;
    }
    public function aboutUs()
    {
        $data['aboutUs'] = AboutUs::first();
        $data['teams'] = Team::all();
        $data['galleries'] = AboutUsGallery::orderBy('display_order', 'asc')->get();
        return $data;
    }

    public function rearchArticle()
    {
//        $data['researchArticles'] = ResearchArticle::all();
//        return $data;

        $researchArticle = ResearchArticle::first();
        if ($researchArticle) {
            return $researchArticle;
        } else {
            return redirect('/');
        }
    }

    public function security()
    {
        $security = Security::first();
        if ($security) {
            return $security;
        } else {
            return redirect('/');
        }
    }
}
