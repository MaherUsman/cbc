<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnimalGalleryStoreRequest;
use App\Http\Requests\AnimalGalleryUpdateRequest;
use App\Models\Animal;
use App\Models\AnimalGallery;
use App\Services\AnimalGalleryService;
use Illuminate\Http\Request;

class AnimalGalleryController extends Controller
{
    public $animalGalleryService;

    public function __construct(AnimalGalleryService $animalGalleryService)
    {
        $this->animalGalleryService = $animalGalleryService;
    }

    public function index(Animal $animal)
    {
        return $this->animalGalleryService->index($animal);
    }

    public function gridView(Animal $animal)
    {
        return $this->animalGalleryService->getImageObjects($animal);
    }

    public function create(Animal $animal)
    {
        return $this->animalGalleryService->create($animal);
    }

    public function store(AnimalGalleryStoreRequest $request, Animal $animal)
    {
        return $this->animalGalleryService->store($request, $animal);
    }

    public function show(AnimalGallery $animalGallery)
    {
        //
    }

    public function edit(AnimalGallery $animalGallery)
    {
        return $this->animalGalleryService->edit($animalGallery);
    }

    public function update(AnimalGalleryUpdateRequest $request, AnimalGallery $animalGallery)
    {
        return $this->animalGalleryService->update($request, $animalGallery);
    }

    public function updateOrder(Request $request)
    {
        return $this->animalGalleryService->updateOrder($request);
    }

    public function destroy(AnimalGallery $animalGallery)
    {
        return $this->animalGalleryService->destroy($animalGallery);
    }
}
