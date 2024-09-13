<?php

namespace App\Http\Controllers;

use App\DataTables\SliderDataTable;
use App\Http\Requests\SliderStoreRequest;
use App\Http\Requests\SliderUpdateRequest;
use App\Http\Resources\SliderCollection;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use App\Services\SliderService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SliderController extends Controller
{
    public $sliderService;

    public function __construct(SliderService $sliderService)
    {
        $this->sliderService= $sliderService;
    }

    public function index(SliderDataTable $dataTable)
    {
        return $this->sliderService->index($dataTable);
    }

    public function gridView()
    {
        return $this->sliderService->getSliders();
    }

    public function create()
    {
        return $this->sliderService->create();
    }

    public function store(SliderStoreRequest $request)
    {
        return $this->sliderService->store($request);
    }

    public function show(Slider $slider)
    {
        //
    }

    public function edit(Slider $slider)
    {
        return $this->sliderService->edit($slider);
    }

    public function update(SliderUpdateRequest $request, Slider $slider)
    {
        return $this->sliderService->update($request , $slider);
    }

    public function updateOrder(Request $request)
    {
        return $this->sliderService->updateOrder($request);
    }

    public function destroy(Slider $slider)
    {
        return $this->sliderService->destroy($slider);
    }
}
