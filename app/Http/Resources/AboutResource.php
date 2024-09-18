<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slink' => $this->slink,
            'details' => $this->details,
            'image' => $this->image,
            'display_order' => $this->display_order,
            'status' => $this->status,
        ];
    }
}
