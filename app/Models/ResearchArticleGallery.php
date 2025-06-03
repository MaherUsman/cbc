<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResearchArticleGallery extends Model
{
    use HasFactory;

    protected $fillable = ['research_article_id', 'image', 'title'];

    public function researchArticle()
    {
        return $this->belongsTo(ResearchArticle::class);
    }
}
