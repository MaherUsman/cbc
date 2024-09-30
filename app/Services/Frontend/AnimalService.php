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
    public function listingAnimals($search = null)
    {
        $query = Animal::query(); // Assuming Animal is your model

        if (!empty($search)) {
            $query->where('title', 'LIKE', '%' . $search . '%'); // Adjust field name if different
        }

        $data['animals'] = $query->paginate(10);
//        $data['animals'] = Animal::paginate(9);
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
