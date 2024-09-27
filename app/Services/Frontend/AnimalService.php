<?php

namespace App\Services\Frontend;

use App\Models\Animal;
use App\Models\AnimalCategory;

class AnimalService
{
    public function findAnimal($slug)
    {
        $data['animal'] = Animal::where('slug' , $slug)
            ->with('animalProps' , 'animalGalleries')
            ->first();
        $data['relatedAnimals'] = Animal::inRandomOrder()
            ->limit(3)
            ->get();
        return $data;
    }
    public function listingAnimals()
    {
        $data['animals'] = Animal::paginate(3);
        return $data;
    }
    public function animalCategories()
    {
        $data['categories'] = AnimalCategory::paginate(10);
        return $data;
    }
}
