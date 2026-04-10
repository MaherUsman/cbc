<?php

namespace App\Services;

use App\Http\Requests\TobaGalleryUpdateRequest;
use App\Http\Resources\TobaGalleryCollection;
use App\Http\Resources\TobaGalleryResource;
use App\Models\TobaGallery;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TobaGalleryService
{
    public function index()
    {
        $tobaGalleries = TobaGallery::all();
        return view('admin.tobaGallery.index', compact('tobaGalleries'));
    }

    public function getTobaGallery()
    {
        $tobaGalleries = TobaGallery::all();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new TobaGalleryCollection($tobaGalleries));
        } else {
            return view('admin.tobaGallery.index', compact('tobaGalleries'));
        }
    }

    public function create()
    {
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            return view('admin.tobaGallery.createGallery');
        }
    }

    public function store(/*TobaGalleryStore*/Request $request)
    {
        DB::beginTransaction();
        try {
//            dd($request->all());
            foreach ($request->title as $key=>$value){
                $dataToCreate = [
                    'title'=>$value,
                    'display_order'=>$request->display_order[$key] ?? 0,
                    'image'=>$request->image[$key] ?? null,
                    'show_on_navbar'=>$request->show_on_navbar[$key] ?? 1,
                    'description'=>$request->description[$key] ?? null,
                ];

                if ($request->hasFile("banner_image.$key")) {
                    $file = $request->file("banner_image.$key");
                    $filename = time() . "_{$key}_banner." . $file->getClientOriginalExtension();
                    $file->move('uploads/toba_galleries/', $filename);
                    $dataToCreate['banner_image'] = 'uploads/toba_galleries/' . $filename;
                }

                $tobaGallery = TobaGallery::create($dataToCreate);
            }
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $tobaGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(TobaGallery $tobaGallery)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'TobaGallery Details', Response::HTTP_OK, new TobaGalleryResource($tobaGallery));
        } else {
            return view('admin.tobaGallery.show', compact('tobaGallery'));
        }
    }

    public function edit(TobaGallery $tobaGallery)
    {
        if (request()->is('api/*')) {
//            dd($tobaGallery);
            return makeResponse('success', 'TobaGallery Details', Response::HTTP_OK, new TobaGalleryResource($tobaGallery));
        } else {
            return view('admin.tobaGallery.edit', compact('tobaGallery'));
        }
    }

    public function update(TobaGalleryUpdateRequest $request, TobaGallery $tobaGallery)
    {
        DB::beginTransaction();
        try {
            if ($request->has('image') && $request->image != '' && $tobaGallery->image != null && $tobaGallery->image != '') {
                $filePath = public_path($tobaGallery->image);
                if (File::exists($filePath)) {
                    unlink($filePath);
                }
            }

            $validatedData = collect($request->validated())->except('role')->all();
            
            if ($request->hasFile('banner_image')) {
                $file = $request->file('banner_image');
                $filename = time() . '_banner.' . $file->getClientOriginalExtension();
                $file->move('uploads/toba_galleries/', $filename);
                $validatedData['banner_image'] = 'uploads/toba_galleries/' . $filename;
                
                if ($tobaGallery->banner_image && File::exists(public_path($tobaGallery->banner_image))) {
                    unlink(public_path($tobaGallery->banner_image));
                }
            }

            $tobaGallery->update($validatedData);
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $tobaGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(TobaGallery $tobaGallery)
    {
        $tobaGallery->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }
}
