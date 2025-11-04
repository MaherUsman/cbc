<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Security extends Model
{
    use HasFactory;

//    protected $fillable = ['title', 'article_pdf_file'/*'description', 'banner_image'*/];
    protected $guarded = [];

    public function galleries()
    {
        return $this->hasMany(SecurityGallery::class);
    }

    public function securityGalleries()
    {
        return $this->hasMany(SecurityGallery::class);
    }
}
