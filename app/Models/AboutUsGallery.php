<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AboutUsGallery extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    /*protected $fillable = [
        'title',
        'slug',
        'image',
        'status',
    ];*/

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'status' => 'boolean',
    ];

    /**
     * Set the slug attribute dynamically based on the title or provided slug.
     *
     * @param string|null $value
     * @return void
     */
    public function setSlugAttribute($value)
    {
        // If a slug is explicitly provided, use it; otherwise, generate from the title
        $this->attributes['slug'] = $value
            ? Str::slug($value, '-')
            : Str::slug($this->attributes['title'], '-');
    }

    /**
     * Automatically generate slug if not set during model creation or update.
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title, '-');
            }
        });

        static::updating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title, '-');
            }
        });
    }
}
