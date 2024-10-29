<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Animal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'image',
        'image_thumbnail',
        'details',
        'show_on_top_bar',
        'status',
        'display_order',
        'is_homepage',
        'is_amazing',
        'home_image_thumbnail',
        'banner_image_thumbnail',
        'category_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'show_on_top_bar' => 'boolean',
        'status' => 'boolean',
    ];

    public function animalProps()
    {
        return $this->hasMany(AnimalProp::class);
    }

    public function animalGalleries()
    {
        return $this->hasMany(AnimalGallery::class);
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
