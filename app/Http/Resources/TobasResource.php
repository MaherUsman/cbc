<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TobasResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image,
            'details' => $this->details,
            'show_on_navbar' => $this->show_on_top_bar,
            'tobasGalleries' => TopasGalleryCollection::make($this->whenLoaded('tobasGalleries')),
        ];
    }
}
