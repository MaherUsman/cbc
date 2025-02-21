<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderAnimal extends Model
{
    use HasFactory;

    protected $table = 'slider_animal';

    protected $fillable = [
        'title',
        'slink',
        'details',
        'image',
        'is_image',
        'display_order',
        'status',
    ];

     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'status' => 'boolean',
        'is_image' => 'boolean',
    ];
}
