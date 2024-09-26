<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Frontend\GalleryService;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    protected $galleryService;
    public function __construct(GalleryService $galleryService)
    {
        $this->galleryService = $galleryService;
    }
    public function topasGallery()
    {
        $topas = $this->galleryService->topas();
        return view('frontend.gallery.topas');
    }
}
