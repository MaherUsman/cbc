<?php

namespace App\Services;

use App\DataTables\AnimalCategoryDataTable;
use App\Http\Requests\AnimalCategoryStoreRequest;
use App\Http\Requests\AnimalCategoryUpdateRequest;
use App\Http\Resources\AnimalCategoryCollection;
use App\Http\Resources\AnimalCategoryResource;
use App\Models\AnimalCategory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AnimalCategoryService
{
    public function index(AnimalCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.animalCategories.index');
    }

    public function getAnimalCategories()
    {
        $animalCategories = AnimalCategory::all();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new AnimalCategoryCollection($animalCategories));
        } else {
            return view('admin.animalCategories.index', compact('animalCategories'));
        }
    }

    public function create()
    {
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            return view('admin.animalCategories.create');
        }
    }

    public function store(AnimalCategoryStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['slug'] = $request->slug ? : Str::slug($request->name, '-');
//            dd($data);
            $animalCategories = AnimalCategory::create($data);
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $animalCategories);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(AnimalCategory $animalCategories)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'AnimalCategory Details', Response::HTTP_OK, new AnimalCategoryResource($animalCategories));
        } else {
            return view('admin.animalCategories.show', compact('animalCategories'));
        }
    }

    public function edit(AnimalCategory $animalCategory)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'AnimalCategory Details', Response::HTTP_OK, new AnimalCategoryResource($animalCategory));
        } else {
            return view('admin.animalCategories.edit', compact('animalCategory'));
        }
    }

    public function update(AnimalCategoryUpdateRequest $request, AnimalCategory $animalCategory)
    {
        DB::beginTransaction();
        try {
            //($request->has('image') && $request->image != '' && $animalCategory->image != null && $animalCategory->image != '') ? unlink(public_path($animalCategory->image)) : '';
            if (
                $request->has('image') &&
                $request->image != '' &&
                $animalCategory->image != null &&
                $animalCategory->image != ''
            ) {
                $imagePath = public_path($animalCategory->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $animalCategory->update(collect($request->validated())->except('role')->all());
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $animalCategory);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(AnimalCategory $animalCategory)
    {
        $animalCategory->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }
}
