<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnimalResource extends JsonResource
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
            'show_on_top_bar' => $this->show_on_top_bar,
            'status' => $this->status,
            'display_order' => $this->display_order,
            'animalProps' => AnimalPropCollection::make($this->whenLoaded('animalProps')),
            'animalGalleries' => AnimalGalleryCollection::make($this->whenLoaded('animalGalleries')),
        ];
    }
}
