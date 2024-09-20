<?php

namespace App\Http\Controllers;

use App\DataTables\AnimalDataTable;
use App\Http\Requests\AnimalStoreRequest;
use App\Http\Requests\AnimalUpdateRequest;
use App\Http\Resources\AnimalCollection;
use App\Http\Resources\AnimalResource;
use App\Models\Animal;
use App\Services\AnimalService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AnimalController extends Controller
{
    public $animalService;

    public function __construct(AnimalService $animalService)
    {
        $this->animalService= $animalService;
    }

    public function index(AnimalDataTable $dataTable)
    {
        return $this->animalService->index($dataTable);
    }

    public function create()
    {
        return $this->animalService->create();
    }

    public function store(AnimalStoreRequest $request)
    {
        return $this->animalService->store($request);
    }

    public function show(Animal $animal)
    {
        //
    }

    public function edit(Animal $animal)
    {
        return $this->animalService->edit($animal);
    }

    public function update(AnimalUpdateRequest $request, Animal $animal)
    {
        return $this->animalService->update($request , $animal);
    }

    public function destroy(Animal $animal)
    {
        return $this->animalService->destroy($animal);
    }

    public function gridView()
    {
        return $this->animalService->getImageObjects();
    }
    public function updateOrder(Request $request)
    {
        return $this->animalService->updateOrder($request);
    }
}
