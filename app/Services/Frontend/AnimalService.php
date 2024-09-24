<?php

namespace App\Services\Frontend;

use App\Models\Animal;

class AnimalService
{
    public function findAnimal($slug)
    {
        $data['animal'] = Animal::where('slug' , $slug)
            ->with('animalProps' , 'animalGalleries')
            ->first();
        $data['relatedAnimals'] = Animal::limit(3);
        return $data;
    }
    public function listingAnimals()
    {
        $data['animals'] = Animal::paginte(10);
        return $data;
    }
}
