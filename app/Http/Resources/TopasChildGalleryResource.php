<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TopasChildGalleryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'topas_gallery_id' => $this->topas_gallery_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image,
            'status' => $this->status,
        ];
    }
}
