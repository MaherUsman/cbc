<?php

namespace App\Services\Frontend;

use App\Models\Blog;

class EventService
{
    public function findEvent($slug)
    {
        $data['event'] = Blog::where('slug' , $slug)->firstOrFail();
        $data['recentEvents'] = Blog::orderBy('created_at' , 'DESC')->limit(3)->get();
        return $data;
    }
    public function allEvents()
    {
        $data['events'] = Blog::all();
        $data['recentEvents'] = Blog::orderBy('created_at' , 'DESC')->limit(3)->get();
        return $data;
    }
}
