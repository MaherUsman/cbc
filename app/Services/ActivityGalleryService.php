<?php

namespace App\Services;

use App\Http\Requests\AboutUsGalleryStoreRequest;
use App\Http\Requests\AboutUsGalleryUpdateRequest;
use App\Http\Requests\ActivityGalleryUpdateRequest;
use App\Http\Resources\AboutUsGalleryCollection;
use App\Http\Resources\AboutUsGalleryResource;
use App\Http\Resources\ActivityGalleryCollection;
use App\Http\Resources\ActivityGalleryResource;
use App\Models\AboutUsGallery;
use App\Models\ActivityGallery;
use App\Models\GalleriesContent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ActivityGalleryService
{
    public function index()
    {
        $activityGalleries = ActivityGallery::all();
        $topasGalleriesContent = GalleriesContent::where('type', 'activity')->first();
        return view('admin.activityGallery.index', compact('activityGalleries', 'topasGalleriesContent'));
    }

    public function getActivityGallery()
    {
        $activityGalleries = ActivityGallery::all();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new ActivityGalleryCollection($activityGalleries));
        } else {
            return view('admin.activityGallery.index', compact('activityGalleries'));
        }
    }

    public function create()
    {
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            return view('admin.activityGallery.createGallery');
        }
    }

    public function store(/*ActivityGalleryStore*/Request $request)
    {
        DB::beginTransaction();
        try {
//            dd($request->all());
            foreach ($request->title as $key=>$value){
                $activityGallery = ActivityGallery::create(['title'=>$value,
                    'image'=>$request->image[$key],
                    'thumb'=>$request->thumb,
                    'compressed'=>$request->compressed,
                    ]);
            }
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $activityGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(ActivityGallery $activityGallery)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'ActivityGallery Details', Response::HTTP_OK, new ActivityGalleryResource($activityGallery));
        } else {
            return view('admin.activityGallery.show', compact('activityGallery'));
        }
    }

    public function edit(ActivityGallery $activityGallery)
    {
        if (request()->is('api/*')) {
//            dd($activityGallery);
            return makeResponse('success', 'ActivityGallery Details', Response::HTTP_OK, new ActivityGalleryResource($activityGallery));
        } else {
            return view('admin.activityGallery.edit', compact('activityGallery'));
        }
    }

    public function update(ActivityGalleryUpdateRequest $request, ActivityGallery $activityGallery)
    {
        DB::beginTransaction();
        try {
            if (
                $request->has('image') &&
                $request->image != '' &&
                $activityGallery->image != null &&
                $activityGallery->image != ''
            ) {
                $imagePath = public_path($activityGallery->image);

                // Check if the file exists before attempting to delete it
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $activityGallery->update(collect($request->validated())->except('role')->all());
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $activityGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(ActivityGallery $activityGallery)
    {
        $activityGallery->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }
}
