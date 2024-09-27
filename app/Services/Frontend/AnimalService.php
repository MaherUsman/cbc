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
        $data['relatedAnimals'] = Animal::limit(3);
        return $data;
    }
    public function listingAnimals()
    {
        $data['animals'] = Animal::paginate(9);
        return $data;
    }
    public function listingAnimalCategory($slug)
    {
        $category = AnimalCategory::where('slug' , $slug)->first();
        $data['animals'] = Animal::where('category_id' , $category->id)->paginate(9);
        $data['category'] = $category;
        return $data;
    }
    public function animalCategories()
    {
        $data['categories'] = AnimalCategory::paginate(10);
        return $data;
    }
}
