<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Animal;
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
            return view('frontend.partials.animal-listings-items', $animals)->render();
        }

        return view('frontend.animal-listing', $animals);
    }

}
