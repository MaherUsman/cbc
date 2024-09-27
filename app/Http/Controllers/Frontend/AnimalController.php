<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\AnimalCategory;
use App\Services\Frontend\AnimalService;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    protected $animalService;
    public function __construct(AnimalService $animalService)
    {
        $this->animalService = $animalService;
    }
    public function findAnimal($slug)
    {
        $animal = $this->animalService->findAnimal($slug);
        return view('frontend.animal', $animal);
    }
    public function listingAnimal(Request $request)
    {
        $animals = $this->animalService->listingAnimals();
        if ($request->ajax()) {

            $morePages = $animals['animals']->hasMorePages();
            return response()->json([
                'html' => view('frontend.partials.animal-listings-items', ['animals' => $animals['animals']])->render(),
                'morePages' => $morePages,
            ]);
        }

        return view('frontend.animal-listing', $animals);
    }
    public function listingAnimalCategory(Request $request , $slug)
    {
        $animals = $this->animalService->listingAnimalCategory($slug);
        if ($request->ajax()) {

            $morePages = $animals['animals']->hasMorePages();
            return response()->json([
                'html' => view('frontend.partials.animal-listings-items', ['animals' => $animals['animals']])->render(),
                'morePages' => $morePages,
            ]);
        }

        return view('frontend.animal-listing', $animals);
    }
    public function searchAnimal()
    {
        return view('frontend.animal-search');
    }

    public function animalCategories(Request $request)
    {
        $categories = $this->animalService->animalCategories();
        if ($request->ajax()) {
            $morePages = $categories['categories']->hasMorePages();
            return response()->json([
                'html' => view('frontend.gallery.partials.animal-categories', ['categories' => $categories['categories']])->render(),
                'morePages' => $morePages,
            ]);
        }
        return view('frontend.animal-categories', $categories);
    }

}
