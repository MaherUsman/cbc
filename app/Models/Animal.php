<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'details',
        'show_on_top_bar',
        'status',
        'display_order',
        'is_homepage',
        'is_amazing',
        'home_image',
        'banner_image'
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
}
