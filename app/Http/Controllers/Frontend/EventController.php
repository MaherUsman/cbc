<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Frontend\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $service;

    public function __construct(EventService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        $data = $this->service->allEvents();
        return view('frontend.events-listing', $data);
    }
    public function findEvent($slug)
    {
        $data = $this
            ->service
            ->findEvent($slug);
        return view('frontend.event' , $data);
    }

    public function loadMoreEventGalleries($slug)
    {
        $galleries  = $this->service->loadMoreEventGalleries($slug);
        return response()->json($galleries);
    }


}
