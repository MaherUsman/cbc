<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TopasChildGallery extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'topas_gallery_id',
        'title',
        'slug',
        'image',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'topas_gallery_id' => 'integer',
        'status' => 'boolean',
    ];

    public function topasGallery(): BelongsTo
    {
        return $this->belongsTo(TopasGallery::class);
    }
}
