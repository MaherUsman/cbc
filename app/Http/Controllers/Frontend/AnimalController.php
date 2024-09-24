<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
}
