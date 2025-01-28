<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitySubGallery extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function activityGallery()
    {
        return $this->belongsTo(ActivityGallery::class);
    }
}
