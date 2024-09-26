<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitorChildGallery extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'visitor_gallery_id',
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
        'visitor_gallery_id' => 'integer',
        'status' => 'boolean',
    ];

    public function visitorGallery(): BelongsTo
    {
        return $this->belongsTo(VisitorGallery::class);
    }
}
