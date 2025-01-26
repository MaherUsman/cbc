<?php

namespace App\Services;

use App\Models\ActivitySubGallery;
use App\Models\TobaSubGallery;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RewampActivitySubGalleryService
{
    public function index($tobaGallery)
    {
        $tobaSubGalleries = ActivitySubGallery::where('activity_gallery_id', $tobaGallery->id)->get();

        return view('admin.rewamp_activity_sub_gallery.index', compact('tobaSubGalleries','tobaGallery'));
    }

    public function getTobaSubGallery()
    {
        $tobaSubGalleries = ActivitySubGallery::all();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new TobaSubGalleryCollection($tobaSubGalleries));
        } else {
            return view('admin.rewamp_activity_sub_gallery.index', compact('tobaSubGalleries'));
        }
    }

    public function create()
    {
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            return view('admin.rewamp_activity_sub_gallery.createGallery');
        }
    }

    public function store(/*TobaSubGalleryStore*/Request $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->title as $key=>$value){
                $tobaSubGallery = ActivitySubGallery::create(['activity_gallery_id'=>$request->topas_gallery_id,
                    'title'=>$value,
                    'image'=>$request->image[$key],
//                    'thumb'=>$request->thumb,
//                    'compressed'=>$request->compressed,
                ]);
            }
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $tobaSubGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(ActivitySubGallery $tobaSubGallery)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'TobaSubGallery Details', Response::HTTP_OK, new TobaSubGalleryResource($tobaSubGallery));
        } else {
            return view('admin.rewamp_activity_sub_gallery.show', compact('tobaSubGallery'));
        }
    }

    public function edit(ActivitySubGallery $visitorChildGallery)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'TobaSubGallery Details', Response::HTTP_OK, new TobaSubGalleryResource($tobaSubGallery));
        } else {
            return view('admin.rewamp_activity_sub_gallery.edit', compact('visitorChildGallery'));
        }
    }

    public function update(Request $request, ActivitySubGallery $tobaSubGallery)
    {
        DB::beginTransaction();
        try {
//            dd($request->all());
            if ($request->has('image') && $request->image != '' && $tobaSubGallery->image != null && $tobaSubGallery->image != '') {
                $filePath = public_path($tobaSubGallery->image);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            $tobaSubGallery->update(collect($request->all())->except('role')->all());
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $tobaSubGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(ActivitySubGallery $tobaSubGallery)
    {
        $tobaSubGallery->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }
}
