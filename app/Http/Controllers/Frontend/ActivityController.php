<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityGallery;
use App\Models\Toba;
use App\Models\TobaGallery;
use App\Models\TobaSubGallery;
use App\Services\Frontend\GalleryService;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $data = Activity::first();

        $tobaGalleries = ActivityGallery::orderBy('id', 'desc')->get();


        return view('frontend.activity-rewamp',compact('data','tobaGalleries'));
    }

    public function topasGallery(Request $request,ActivityGallery $tobasGallery)
    {

        $galleryService =  new GalleryService();
        $page = $request->get('page', 1);
        $tobaGallery = $galleryService->activityGallery($page , $tobasGallery->id);

        if ($request->ajax()) {

            $morePages = $tobaGallery['topasGallery']->hasMorePages();
            return response()->json([
                'html' => view('frontend.gallery.partials.activity-gallery-items', ['topasGallery' => $tobaGallery['tobasGallery']])->render(),
                'morePages' => $morePages,
            ]);
        }
        return view('frontend.gallery.tobas', compact('tobaGallery'));

//        return view('frontend.gallery.tobas',compact('tobasGallery'));
    }
}
