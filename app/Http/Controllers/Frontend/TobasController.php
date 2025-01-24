<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Toba;
use App\Models\TobaGallery;
use App\Models\TobaSubGallery;
use App\Services\Frontend\GalleryService;
use Illuminate\Http\Request;

class TobasController extends Controller
{
    public function index()
    {
        $data = Toba::first();

        $tobaGalleries = TobaGallery::all();

        return view('frontend.tobas-new',compact('data','tobaGalleries'));
    }

    public function topasGallery(Request $request,TobaGallery $tobasGallery)
    {

        $galleryService =  new GalleryService();
        $page = $request->get('page', 1);
        $tobaGallery = $galleryService->tobasGallery($page , $tobasGallery->id);

        if ($request->ajax()) {

            $morePages = $tobaGallery['topasGallery']->hasMorePages();
            return response()->json([
                'html' => view('frontend.gallery.partials.tobas-gallery-items', ['topasGallery' => $tobaGallery['tobasGallery']])->render(),
                'morePages' => $morePages,
            ]);
        }
        return view('frontend.gallery.tobas', compact('tobaGallery'));

//        return view('frontend.gallery.tobas',compact('tobasGallery'));
    }
}
