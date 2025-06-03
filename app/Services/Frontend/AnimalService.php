<?php

namespace App\Services\Frontend;

use App\Models\Animal;
use App\Models\AnimalCategory;

class AnimalService
{
    public function findAnimal($slug)
    {
        $data['animal'] = Animal::where('slug', $slug)
            ->with(['animalProps', 'animalGalleries' => function ($query) {
                $query->paginate(9); // Load only 10 images initially
            }])
            ->first();
        $data['relatedAnimals'] = Animal::inRandomOrder()
            ->limit(3)
            ->get();
        return $data;
    }
    public function loadMoreAnimalGalleries($slug)
    {
        $animal = Animal::where('slug', $slug)->first();
        $galleries = $animal->animalGalleries()->paginate(9); // Paginate by 10 images

        return $galleries;
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
        $data['animals'] = Animal::where('category_id' , $category->id)->orderBy('id', 'desc')->paginate(9);
        $data['category'] = $category;
        return $data;
    }
    public function animalCategories()
    {
        $data['categories'] = AnimalCategory::paginate(10);
        return $data;
    }
}
