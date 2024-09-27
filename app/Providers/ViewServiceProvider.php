<?php

namespace App\Providers;

use App\Models\Animal;
use App\Models\Settings;
use App\Models\SocialLinks;
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

        View::composer('frontend.layout.index', function ($view) {
            $setting = Settings::first();
            $view->with('setting', $setting);
            $animals = Animal::where(function ($q){
                $q->where('slug' , 'black-bucks')
                    ->orWhere('slug' , 'houbara-bustard')
                    ->orWhere('slug' , 'chinkara')
                    ->orWhere('slug' , 'bluebull');
            })
                ->get();
            $view->with('animals', $animals);
        });
    }
}
