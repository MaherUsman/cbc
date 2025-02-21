<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalSlider extends Model
{
    use HasFactory;

    // protected $table = 'slider_animal'; // ✅ Assign the correct table name

    protected $guarded = [];
}
