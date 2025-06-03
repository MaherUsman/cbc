<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'background_image',
        'button_text',
        'button_link',
    ];
}
