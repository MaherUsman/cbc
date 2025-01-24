<?php

namespace App\Services\Frontend;

use App\Models\AboutUsChildGallery;
use App\Models\AboutUsGallery;
use App\Models\ActivityGallery;
use App\Models\GalleriesContent;
use App\Models\TobaGallery;
use App\Models\TobaSubGallery;
use App\Models\TopasGallery;
use App\Models\VisitorGallery;

class GalleryService
{
    public function topas($page = 1)
    {
        $data['topasGallery'] = TopasGallery::paginate(9, ['*'], 'page', $page);
        $data['topasGalleryContent'] = GalleriesContent::where('type', 'topas')->first();
        return $data;
    }
    public function visitors($page = 1)
    {
        $data['visitorGallery'] = VisitorGallery::paginate(9, ['*'], 'page', $page);
        $data['visitorGalleryContent'] = GalleriesContent::where('type', 'visitor')->first();
        return $data;
    }
    public function activites($page = 1)
    {
        $data['activitesGallery'] = ActivityGallery::paginate(9, ['*'], 'page', $page);
        $data['activityGalleryContent'] = GalleriesContent::where('type', 'activity')->first();
        return $data;
    }
    public function aboutUsGallery($page = 1 , $id)
    {
        $data['aboutUsGalleries'] = AboutUsChildGallery::
        where('about_us_gallery_id' , $id)
        ->paginate(9, ['*'], 'page', $page);
        $data['id'] = $id;
        $data['parentGallery'] = AboutUsGallery::where('id', $id)->first();
        return $data;
    }
    public function tobasGallery($page = 1 , $id)
    {
        $data['topasGallery'] = TobaSubGallery::
        where('toba_gallery_id' , $id)
            ->paginate(9, ['*'], 'page', $page);
        $data['id'] = $id;
        $data['parentGallery'] = TobaGallery::where('id', $id)->first();
        return $data;
    }

}

