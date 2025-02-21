<?php

namespace App\Http\Controllers;

use App\DataTables\SliderDataTable;
use App\Http\Requests\SliderStoreRequest;
use App\Http\Requests\SliderUpdateRequest;
use App\Models\SliderAnimal;
use App\Services\SliderAnimalService;
use App\DataTables\SliderAnimalDataTable;
use App\Http\Requests\SliderAnimalUpdateRequest;
use Illuminate\Http\Request;

class SliderAnimalController extends Controller
{
    public $sliderAnimalService;

    public function __construct(SliderAnimalService $sliderAnimalService)
    {
        $this->sliderAnimalService = $sliderAnimalService;
    }

    public function index(SliderAnimalDataTable $dataTable)
    {
        return $this->sliderAnimalService->index($dataTable);
    }

    public function gridView()
    {
        return $this->sliderAnimalService->getSliders();
    }

    public function create()
    {
        return $this->sliderAnimalService->create();
    }

    public function store(SliderStoreRequest $request)
    {
        return $this->sliderAnimalService->store($request);
    }

    public function show(SliderAnimal $sliderAnimal)
    {
        return $this->sliderAnimalService->show($sliderAnimal);
    }

    public function edit(SliderAnimal $sliderAnimal)
    {
        return $this->sliderAnimalService->edit($sliderAnimal);
    }

    public function update(SliderAnimalUpdateRequest $request, SliderAnimal $sliderAnimal)
    {
        return $this->sliderAnimalService->update($request, $sliderAnimal);
    }

    public function updateOrder(Request $request)
    {
        return $this->sliderAnimalService->updateOrder($request);
    }

    public function destroy(SliderAnimal $sliderAnimal)
    {
        return $this->sliderAnimalService->destroy($sliderAnimal);
    }
}
