<?php

namespace App\Services;

use App\Http\Requests\AboutUsGalleryStoreRequest;
use App\Http\Requests\AboutUsGalleryUpdateRequest;
use App\Http\Requests\VisitorGalleryUpdateRequest;
use App\Http\Resources\AboutUsGalleryCollection;
use App\Http\Resources\AboutUsGalleryResource;
use App\Http\Resources\VisitorGalleryCollection;
use App\Http\Resources\VisitorGalleryResource;
use App\Models\AboutUsGallery;
use App\Models\GalleriesContent;
use App\Models\VisitorGallery;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class VisitorGalleryService
{
    public function index()
    {
        $visitorGalleries = VisitorGallery::all();
        $topasGalleriesContent = GalleriesContent::where('type', 'visitor')->first();
        return view('admin.visitorGallery.index', compact('visitorGalleries', 'topasGalleriesContent'));
    }

    public function getVisitorGallery()
    {
        $visitorGalleries = VisitorGallery::all();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new VisitorGalleryCollection($visitorGalleries));
        } else {
            return view('admin.visitorGallery.index', compact('visitorGalleries'));
        }
    }

    public function create()
    {
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            return view('admin.visitorGallery.createGallery');
        }
    }

    public function store(/*VisitorGalleryStore*/Request $request)
    {
        DB::beginTransaction();
        try {
//            dd($request->all());
            foreach ($request->title as $key=>$value){
                $visitorGallery = VisitorGallery::create(['title'=>$value,'image'=>$request->image[$key]]);
            }
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $visitorGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(VisitorGallery $visitorGallery)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'VisitorGallery Details', Response::HTTP_OK, new VisitorGalleryResource($visitorGallery));
        } else {
            return view('admin.visitorGallery.show', compact('visitorGallery'));
        }
    }

    public function edit(VisitorGallery $visitorGallery)
    {
        if (request()->is('api/*')) {
//            dd($visitorGallery);
            return makeResponse('success', 'VisitorGallery Details', Response::HTTP_OK, new VisitorGalleryResource($visitorGallery));
        } else {
            return view('admin.visitorGallery.edit', compact('visitorGallery'));
        }
    }

    public function update(VisitorGalleryUpdateRequest $request, VisitorGallery $visitorGallery)
    {
        DB::beginTransaction();
        try {
            if (
                $request->has('image') &&
                $request->image != '' &&
                $visitorGallery->image != null &&
                $visitorGallery->image != ''
            ) {
                $imagePath = public_path($visitorGallery->image);

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $visitorGallery->update(collect($request->validated())->except('role')->all());
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $visitorGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(VisitorGallery $visitorGallery)
    {
        $visitorGallery->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }
}
