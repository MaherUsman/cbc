<?php

namespace App\Services;

use App\DataTables\SliderDataTable;
use App\Http\Requests\SliderStoreRequest;
use App\Http\Requests\SliderUpdateRequest;
use App\Http\Resources\SliderCollection;
use App\Http\Resources\SliderResource;
use App\Models\SliderAnimal;
use App\DataTables\SliderAnimalDataTable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SliderAnimalService
{
    public function index(SliderAnimalDataTable $dataTable)
    {
        return $dataTable->render('admin.Animalslider.index');
    }

    public function getSliders()
    {
        $sliders = SliderAnimal::orderBy('display_order', 'asc')->get();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new SliderCollection($sliders));
        } else {
            return view('admin.Animalslider.reorder', compact('sliders'));
        }
    }

    public function create()
    {
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            return view('admin.Animalslider.create');
        }
    }

    public function store(SliderStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $slider = SliderAnimal::create(collect($request->validated())->all());
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $slider);
        } catch (\Exception $exception) {
            DB::rollBack();
            return makeResponse('error', 'Error: ' . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(SliderAnimal $slider)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'Slider Details', Response::HTTP_OK, new SliderResource($slider));
        } else {
            return view('admin.Animalslider.show', compact('slider'));
        }
    }

    public function edit(SliderAnimal $slider_animal)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'Slider Details', Response::HTTP_OK, new SliderResource($slider_animal));
        } else {
            return view('admin.Animalslider.edit', compact('slider_animal'));
        }
    }

    public function update(SliderUpdateRequest $request, SliderAnimal $slider)
    {
        DB::beginTransaction();
        try {
            if (
                $request->has('image') &&
                $request->image != '' &&
                !empty($slider->image) &&
                file_exists(public_path($slider->image))
            ) {
                unlink(public_path($slider->image));
            }
            $slider->update(collect($request->validated())->except('role')->all());
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $slider);
        } catch (\Exception $exception) {
            DB::rollBack();
            return makeResponse('error', 'Error: ' . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->order as $key => $order) {
                SliderAnimal::where('id', $order)->update(['display_order' => $key + 1]);
            }
            DB::commit();
            return makeResponse('success', 'Order Updated', 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return makeResponse('error', 'Error: ' . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(SliderAnimal $slider)
    {
        $slider->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }
}
