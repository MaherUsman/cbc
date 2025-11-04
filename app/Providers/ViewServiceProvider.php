<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\ActivityGallery;
use App\Models\Animal;
use App\Models\AnimalCategory;
use App\Models\ArticleGallery;
use App\Models\Settings;
use App\Models\SocialLinks;
use App\Models\Toba;
use App\Models\TobaGallery;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('frontend.partials.social_links', function ($view) {
            $socialLinks = SocialLinks::all();
            $view->with('socialLinks', $socialLinks);
        });

        View::composer('frontend.index', function ($view) {
            $setting = Settings::first();
            $view->with('setting', $setting);
        });
        View::composer('frontend.layout.index', function ($view) {
            $setting = Settings::first();
            $view->with('setting', $setting);
            $animals = Animal::where(function ($q){
                $q->where('slug' , 'black-bucks')
                    ->orWhere('slug' , 'houbara-bustard')
                    ->orWhere('slug' , 'chinkara')
                    ->orWhere('slug' , 'other-species')
                    ->orWhere('slug' , 'blue-bull');
            })
                ->orderBy('display_order' , 'ASC')
                ->get();
            $category = AnimalCategory::first();

            $tobasGalleries = TobaGallery::where('show_on_navbar',1)->get();
            $articleGalleries = ArticleGallery::where('show_on_navbar',1)->get();
            $activityGalleries = ActivityGallery::where('show_on_navbar',1)->get();


            $view->with('animals', $animals);
            $view->with('category', $category);
            $view->with('tobasGalleries', $tobasGalleries);
            $view->with('articleGalleries', $articleGalleries);
            $view->with('activityGalleries', $activityGalleries);
        });
    }
}
