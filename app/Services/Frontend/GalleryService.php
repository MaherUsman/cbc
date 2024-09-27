<?php

namespace App\Services\Frontend;

use App\Models\TopasGallery;
use App\Models\VisitorGallery;

class GalleryService
{
    public function topas($page = 1)
    {
        $data['topasGallery'] = TopasGallery::paginate(9, ['*'], 'page', $page);
        return $data;
    }
    public function visitors($page = 1)
    {
        $data['visitorGallery'] = VisitorGallery::paginate(9, ['*'], 'page', $page);
        return $data;
    }
}
