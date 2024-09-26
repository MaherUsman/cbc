<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitorChildGalleryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visitor_gallery_id' => $this->visitor_gallery_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image,
            'status' => $this->status,
            'visitorGallery' => VisitorGalleryResource::make($this->whenLoaded('visitorGallery')),
        ];
    }
}
