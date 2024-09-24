<?php

namespace App\Services\Frontend;

use App\Models\Animal;

class AnimalService
{
    public function findAnimal($slug)
    {
        return Animal::where('slug' , $slug)->first();
    }
}
