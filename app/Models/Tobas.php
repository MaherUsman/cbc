<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tobas extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function tobasGalleries()
    {
        return $this->hasMany(TopasGallery::class);
    }

    // Mutator for slug
    public function setSlugAttribute($value)
    {
        // Check if a slug is provided
        if ($value) {
            $this->attributes['slug'] = Str::slug($value, '-');
        } else {
            $this->attributes['slug'] = Str::slug($this->attributes['name'], '-');
        }
    }

}
