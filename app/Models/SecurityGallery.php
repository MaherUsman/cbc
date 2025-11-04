<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SecurityGallery extends Model
{
    use HasFactory;

    protected $fillable = ['security_id', 'image', 'title'];

    public function security()
    {
        return $this->belongsTo(Security::class);
    }
}
