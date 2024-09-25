<?php

namespace App\Services;

use App\DataTables\AnimalDataTable;
use App\Http\Requests\AnimalStoreRequest;
use App\Http\Requests\AnimalUpdateRequest;
use App\Http\Resources\AnimalCollection;
use App\Http\Resources\AnimalResource;
use App\Models\Animal;
use App\Models\AnimalCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AnimalService
{
    public function index(AnimalDataTable $dataTable)
    {
        return $dataTable->render('admin.animal.index');
    }

    public function getAnimals()
    {
        $animals = Animal::all();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new AnimalCollection($animals));
        } else {
            return view('admin.animal.index', compact('animals'));
        }
    }

    public function create()
    {
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            $animalCategories = AnimalCategory::all();
            return view('admin.animal.create', compact('animalCategories'));
        }
    }

    public function store(AnimalStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $this->record($request);
            $animal = Animal::create($data['animal']);
            count($data['props']) > 0 ? $animal->animalProps()->createMany($data['props']) : '';
            count($data['gallery']) > 0 ? $animal->animalGalleries()->createMany($data['gallery']) : '';
            DB::commit();
            return makeResponse('success', 'Added Successfully!', Response::HTTP_CREATED, $animal);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Animal $animal)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'Animal Details', Response::HTTP_OK, new AnimalResource($animal));
        } else {
            return view('admin.animal.show', compact('animal'));
        }
    }

    public function edit(Animal $animal)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'Animal Details', Response::HTTP_OK, new AnimalResource($animal));
        } else {
            $animalCategories = AnimalCategory::all();
            return view('admin.animal.edit', compact('animal','animalCategories'));
        }
    }

    public function update(AnimalUpdateRequest $request, Animal $animal)
    {
        DB::beginTransaction();
        try {
//            dd($request->all());
//            ($request->has('image') && $request->image != '' && $animal->image != null && $animal->image != '') ? unlink(public_path($animal->image)) : '';
            $data = $this->record($request);
            $animal->update(collect($request->validated())->except('role')->all());

            // Remove previous props associated with the animal
            $animal->animalProps()->where('animal_id', $animal->id)->delete();

            // Insert new props if they exist
            if (count($data['props']) > 0) {
                $animal->animalProps()->createMany($data['props']);
            }
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $animal);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Animal $animal)
    {
        $animal->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }

    private function record(Request $request)
    {
        $data = $props = $gallery = [];
        $data['animal'] = [
            'title' => $request->title,
            'slug' => $request->slug?:Str::slug($request->title, '-'),
            'category_id' => $request->category_id,
            'image' => $request->image,
            'details' => $request->details,
            'show_on_top_bar' => $request->show_on_top_bar ?: 0,
            'is_amazing' => $request->is_amazing ?: 'no',
            'home_image' => $request->home_image,
            'banner_image' => $request->banner_image,
            //'status' => $request->status?:1,
            //'display_order' => $request->display_order?:1,
        ];
        foreach ($request->prop_title as $key => $value) {
            if (!empty($request->prop_title[$key]) && !empty($request->prop_details[$key])) {
                $props[] = [
                    'title' => $request->prop_title[$key],
                    'details' => $request->prop_details[$key],
                    //'status' => $request->status ?: 1,
                    //'display_order' => $request->display_order ?: 1,
                ];
            }
        }
        $data['props'] = $props;
//        dd($request->gal_title);
        if (isset($request->gal_title)){
            foreach ($request->gal_title as $key => $value) {

                $gallery[] = [
                    'title' => $request->gal_title[$key],
                    'image' => $request->gal_image[$key],
                    //'status' => $request->status?:1,
                    //'display_order' => $request->display_order?:1,
                ];
            }
        }

        $data['gallery'] = $gallery;

        return $data;
    }

    public function getImageObjects()
    {
        $animals = Animal::orderBy('display_order','asc')->get();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new AnimalCollection($animals));
        } else {
            return view('admin.animal.reorder', compact('animals'));
//            return view('admin.animal.gallery', compact('animals'));
        }
    }
    public function updateOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->order as $key => $order) {
                Animal::where('id', $order)->update(['display_order' => $key + 1]);
            }
            DB::commit();
            return makeResponse('success', 'Order Updated', 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
