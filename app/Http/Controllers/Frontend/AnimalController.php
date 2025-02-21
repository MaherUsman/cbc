<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\AnimalCategory;
use App\Models\SliderAnimal;
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
    public function loadMoreAnimalGalleries($slug)
    {
        $galleries  = $this->animalService->loadMoreAnimalGalleries($slug);
        return response()->json($galleries);
    }
    public function listingAnimal(Request $request)
    {

        $search = $request->input('search-field'); 
        $animals = $this->animalService->listingAnimals($search);
        if ($request->ajax()) {

            $morePages = $animals['animals']->hasMorePages();
            return response()->json([
                'html' => view('frontend.partials.animal-listings-items', ['animals' => $animals['animals']])->render(),
                'morePages' => $morePages,
            ]);
        }
        if (!is_array($animals)) {
            $animals = ['animals' => $animals]; // Convert it into an array if it's not
        }    
        return view('frontend.animal-listing', array_merge($animals));
    }
    public function listingAnimalCategory(Request $request , $slug)
    {
        $sliders = SliderAnimal::all();
        // dd($sliders);
        $animals = $this->animalService->listingAnimalCategory($slug);
        if ($request->ajax()) {

            $morePages = $animals['animals']->hasMorePages();
            return response()->json([
                'html' => view('frontend.partials.animal-listings-items', ['animals' => $animals['animals']])->render(),
                'morePages' => $morePages,
            ]);
        }

        return view('frontend.animal-listing' , array_merge($animals, compact('sliders')));
    }
    public function searchAnimal(Request $request)
    {
        $search = $request->input('search-field'); // Capture the search parameter
        $animals = $this->animalService->listingAnimals($search);
        if ($request->ajax()) {

            $morePages = $animals['animals']->hasMorePages();
            return response()->json([
                'html' => view('frontend.partials.animal-listings-items', ['animals' => $animals['animals']])->render(),
                'morePages' => $morePages,
            ]);
        }
        return view('frontend.animal-search', $animals);
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
