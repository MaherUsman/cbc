<?php

namespace App\Services\Frontend;

use App\Models\Blog;

class EventService
{
    public function findEvent($slug)
    {
        $data['event'] = Blog::where('slug' , $slug)
            ->with(['blogGalleries' => function ($query) {
                $query->paginate(9); // Load only 10 images initially
            }])
            ->firstOrFail();
        $data['recentEvents'] = Blog::orderBy('created_at' , 'DESC')->limit(3)->get();
        return $data;
    }
    public function allEvents()
    {
        $data['events'] = Blog::all();
        $data['recentEvents'] = Blog::orderBy('created_at' , 'DESC')->limit(3)->get();
        return $data;
    }

    public function loadMoreEventGalleries($slug)
    {
        $event = Blog::where('slug', $slug)->first();
        $galleries = $event->blogGalleries()->paginate(9); // Paginate by 10 images

        return $galleries;
    }

}
