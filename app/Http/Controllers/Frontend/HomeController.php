<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Frontend\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $service;

    public function __construct(HomeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->index();
        return view('frontend.index' , $data);
    }

    public function aboutUs()
    {
        $data = $this->service->aboutUs();
        return view('frontend.about-us' , $data);
    }

    public function rearchArticle()
    {
        $data = $this->service->rearchArticle();
        return view('frontend.rearch_article' , $data);
    }

    public function contactUs()
    {
        return view('frontend.contact-us');
    }
}
