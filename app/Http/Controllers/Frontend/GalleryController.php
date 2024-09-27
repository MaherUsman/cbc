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
    public function topasGallery(Request $request)
    {
        $page = $request->get('page', 1);
        $data = $this->galleryService->topas($page);

        if ($request->ajax()) {
            return view('frontend.gallery.partials.tobas-gallery-items', ['topasGallery' => $data['topasGallery']])->render();
        }

        return view('frontend.gallery.topas', $data);
    }
    public function visitorsGallery(Request $request)
    {
        $page = $request->get('page', 1);
        $data = $this->galleryService->visitors($page);

        if ($request->ajax()) {

            $morePages = $data['visitorGallery']->hasMorePages();
            return response()->json([
                'html' => view('frontend.gallery.partials.visitors-gallery-items', ['visitorGallery' => $data['visitorGallery']])->render(),
                'morePages' => $morePages,
            ]);
        }

        return view('frontend.gallery.visitors', $data);
    }
    public function aboutUsGallery(Request $request , $slug)
    {
        $page = $request->get('page', 1);
        $data = $this->galleryService->aboutUsGallery($page , $slug);

        if ($request->ajax()) {

            $morePages = $data['aboutUsGalleries']->hasMorePages();
            return response()->json([
                'html' => view('frontend.gallery.partials.aboutus-gallery-items', ['aboutUsGalleries' => $data['aboutUsGalleries']])->render(),
                'morePages' => $morePages,
            ]);
        }

        return view('frontend.gallery.aboutus', $data);
    }
}
