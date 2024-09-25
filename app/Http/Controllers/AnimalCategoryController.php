<?php

namespace App\Http\Controllers;

use App\DataTables\AnimalCategoryDataTable;
use App\Http\Requests\AnimalCategoryStoreRequest;
use App\Http\Requests\AnimalCategoryUpdateRequest;
use App\Models\AnimalCategory;
use App\Services\AnimalCategoryService;
use Illuminate\Http\Request;

class AnimalCategoryController extends Controller
{
    public $animalCategoryService;

    public function __construct(AnimalCategoryService $animalCategoryService)
    {
        $this->animalCategoryService= $animalCategoryService;
    }

    public function index(AnimalCategoryDataTable $dataTable)
    {
        return $this->animalCategoryService->index($dataTable);
    }

    public function create()
    {
        return $this->animalCategoryService->create();
    }

    public function store(AnimalCategoryStoreRequest $request)
    {

        return $this->animalCategoryService->store($request);
    }

    public function show(AnimalCategory $animalCategory)
    {
        //
    }

    public function edit(AnimalCategory $animalCategory)
    {
        return $this->animalCategoryService->edit($animalCategory);
    }

    public function update(AnimalCategoryUpdateRequest $request, AnimalCategory $animalCategory)
    {
        return $this->animalCategoryService->update($request , $animalCategory);
    }

    public function destroy(AnimalCategory $animalCategory)
    {
        return $this->animalCategoryService->destroy($animalCategory);
    }

    public function gridView()
    {
        return $this->animalCategoryService->getImageObjects();
    }
    public function updateOrder(Request $request)
    {
        return $this->animalCategoryService->updateOrder($request);
    }
}
