<?php

namespace App\Services;

use App\DataTables\SliderDataTable;
use App\Http\Requests\SliderStoreRequest;
use App\Http\Requests\SliderUpdateRequest;
use App\Http\Resources\SliderCollection;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SliderService
{
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    public function getSliders()
    {
        $sliders = Slider::orderBy('display_order','asc')->get();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new SliderCollection($sliders));
        } else {
            return view('admin.slider.reorder', compact('sliders'));
        }
    }

    public function create()
    {
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            return view('admin.slider.create');
        }
    }

    public function store(SliderStoreRequest $request)
    {
//        dd($request->all());
        DB::beginTransaction();
        try {
            $slider = Slider::create(collect($request->validated())->all());
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $slider);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Slider $slider)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'Slider Details', Response::HTTP_OK, new SliderResource($slider));
        } else {
            return view('admin.slider.show', compact('slider'));
        }
    }

    public function edit(Slider $slider)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'Slider Details', Response::HTTP_OK, new SliderResource($slider));
        } else {
            return view('admin.slider.edit', compact('slider'));
        }
    }

    public function update(SliderUpdateRequest $request, Slider $slider)
    {
        DB::beginTransaction();
        try {
            if ($request->has('image') &&
                $request->image != '' &&
                $slider->image != null &&
                $slider->image != '' &&
                file_exists(public_path($slider->image))) {
                unlink(public_path($slider->image));
            }
            $slider->update(collect($request->validated())->except('role')->all());
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $slider);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->order as $key => $order) {
                Slider::where('id', $order)->update(['display_order' => $key + 1]);
            }
            DB::commit();
            return makeResponse('success', 'Order Updated', 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }
}
