<?php

namespace App\Services;

use App\Http\Requests\AnimalGalleryStoreRequest;
use App\Http\Requests\AnimalGalleryUpdateRequest;
use App\Http\Resources\AnimalGalleryCollection;
use App\Http\Resources\AnimalGalleryResource;
use App\Models\Animal;
use App\Models\AnimalGallery;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AnimalGalleryService
{
    public function index(Animal $animal)
    {
        //$animalGalleries = $animal->animalGalleries; //AnimalGallery::orderBy('display_order', 'asc')->get();
        $animalGalleries = $animal->animalGalleries()->orderBy('display_order', 'asc')->paginate(10);
        return view('admin.animalGallery.index',compact('animal','animalGalleries'));
    }

    public function create(Animal $animal)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            return view('admin.animalGallery.createGallery', compact('animal'));
        }
    }

    public function store(AnimalGalleryStoreRequest $request, Animal $animal)
    {
        DB::beginTransaction();
        try {
            //$animalGallery = AnimalGallery::create(collect($request->validated())->all());
            $animalGallery = $animal->animalGalleries()->createMany($this->record($request));
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $animalGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(AnimalGallery $animalGallery)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'AnimalGallery Details', Response::HTTP_OK, new AnimalGalleryResource($animalGallery));
        } else {
            return view('admin.animalGallery.show', compact('animalGallery'));
        }
    }

    public function edit(AnimalGallery $animalGallery)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'AnimalGallery Details', Response::HTTP_OK, new AnimalGalleryResource($animalGallery));
        } else {
            return view('admin.animalGallery.edit', compact('animalGallery'));
        }
    }

    public function update(Request $request, AnimalGallery $animalGallery)
    {
        DB::beginTransaction();
        try {
            if (
                $request->has('image') &&
                $request->image != '' &&
                $animalGallery->image != null &&
                $animalGallery->image != ''
            ) {
                $imagePath = public_path($animalGallery->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
//            dd($request->all());
            $animalGallery->update(collect($request->all())->all());
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $animalGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function destroy(AnimalGallery $animalGallery)
    {
        $animalGallery->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }

    public function getImageObjects(Animal $animal)
    {
        //$animalGalleries = $animal->animalGalleries; //AnimalGallery::orderBy('display_order', 'asc')->get();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new AnimalGalleryCollection($animal));
        } else {
            return view('admin.animalGallery.reorder', compact('animal'));
        }
    }

    public function updateOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->order as $key => $order) {
                AnimalGallery::where('id', $order)->update(['display_order' => $key + 1]);
            }
            DB::commit();
            return makeResponse('success', 'Order Updated', 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function record(Request $request)
    {
        $gallery = [];
        foreach ($request->title as $key => $value) {
            $gallery[] = [
                'title' => $request->title[$key],
                'image' => $request->image[$key],
                //'status' => $request->status?:1,
                //'display_order' => $request->display_order?:1,
            ];
        }
        return $gallery;
    }
}
