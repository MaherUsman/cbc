<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TobaGallery extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function setSlugAttribute($value)
    {
        // Check if a slug is provided
        if ($value) {
            $this->attributes['slug'] = Str::slug($value, '-');
        } else {
            $this->attributes['slug'] = Str::slug($this->attributes['name'], '-');
        }
    }

    public function tobaSubGalleries()
    {
        return $this->hasMany(TobaSubGallery::class);
    }
}
