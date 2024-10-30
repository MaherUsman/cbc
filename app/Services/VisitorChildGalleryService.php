<?php

namespace App\Services;

use App\Http\Requests\AboutUsGalleryStoreRequest;
use App\Http\Requests\AboutUsGalleryUpdateRequest;
use App\Http\Requests\VisitorChildGalleryUpdateRequest;
use App\Http\Requests\VisitorGalleryUpdateRequest;
use App\Http\Resources\AboutUsGalleryCollection;
use App\Http\Resources\AboutUsGalleryResource;
use App\Http\Resources\VisitorChildGalleryCollection;
use App\Http\Resources\VisitorChildGalleryResource;
use App\Http\Resources\VisitorGalleryCollection;
use App\Http\Resources\VisitorGalleryResource;
use App\Models\AboutUsGallery;
use App\Models\VisitorChildGallery;
use App\Models\VisitorGallery;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class VisitorChildGalleryService
{
    public function index($visitorGallery)
    {
        $visitorChildGalleries = VisitorChildGallery::where('visitor_gallery_id', $visitorGallery->id)->get();
        return view('admin.visitorChildGallery.index', compact('visitorChildGalleries', 'visitorGallery'));
    }

    public function getVisitorChildGallery()
    {
        $visitorChildGalleries = VisitorChildGallery::all();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new VisitorChildGalleryCollection($visitorChildGalleries));
        } else {
            return view('admin.visitorChildGallery.index', compact('visitorChildGalleries'));
        }
    }

    public function create()
    {
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            return view('admin.visitorChildGallery.createGallery');
        }
    }

    public function store(/*VisitorChildGalleryStore*/Request $request)
    {
        DB::beginTransaction();
        try {
//            dd($request->all());
            foreach ($request->title as $key=>$value){
                $visitorChildGallery = VisitorChildGallery::create(['visitor_gallery_id'=>$request->visitor_gallery_id,'title'=>$value,'image'=>$request->image[$key]]);
            }
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $visitorChildGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(VisitorChildGallery $visitorChildGallery)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'VisitorChildGallery Details', Response::HTTP_OK, new VisitorChildGalleryResource($visitorChildGallery));
        } else {
            return view('admin.visitorChildGallery.show', compact('visitorChildGallery'));
        }
    }

    public function edit(VisitorChildGallery $visitorChildGallery)
    {
        if (request()->is('api/*')) {
//            dd($visitorChildGallery);
            return makeResponse('success', 'VisitorChildGallery Details', Response::HTTP_OK, new VisitorChildGalleryResource($visitorChildGallery));
        } else {
            return view('admin.visitorChildGallery.edit', compact('visitorChildGallery'));
        }
    }

    public function update(VisitorChildGalleryUpdateRequest $request, VisitorChildGallery $visitorChildGallery)
    {
        DB::beginTransaction();
        try {
            //($request->has('image') && $request->image != '' && $visitorChildGallery->image != null && $visitorChildGallery->image != '') ? unlink(public_path($visitorChildGallery->image)) : '';
            if (
                $request->has('image') &&
                $request->image != '' &&
                $visitorChildGallery->image != null &&
                $visitorChildGallery->image != ''
            ) {
                $imagePath = public_path($visitorChildGallery->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $visitorChildGallery->update(collect($request->validated())->except('role')->all());
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $visitorChildGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(VisitorChildGallery $visitorChildGallery)
    {
        $visitorChildGallery->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }
}
