<?php

namespace App\Services;

use App\Http\Requests\TopasChildGalleryUpdateRequest;
use App\Http\Resources\TopasChildGalleryCollection;
use App\Http\Resources\TopasChildGalleryResource;
use App\Models\TobaSubGallery;
use App\Models\TopasChildGallery;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TopasChildGalleryService
{
    public function index($topasGallery)
    {
        $topasChildGalleries = TobaSubGallery::where('topas_gallery_id', $topasGallery->id)->get();
        return view('admin.topasChildGallery.index', compact('topasChildGalleries', 'topasGallery'));
    }

    public function getTopasChildGallery()
    {
        $topasChildGalleries = TobaSubGallery::all();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new TopasChildGalleryCollection($topasChildGalleries));
        } else {
            return view('admin.topasChildGallery.index', compact('topasChildGalleries'));
        }
    }

    public function create()
    {
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            return view('admin.topasChildGallery.createGallery');
        }
    }

    public function store(/*TopasChildGalleryStore*/Request $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->title as $key=>$value){
                $topasChildGallery = TobaSubGallery::create(['toba_gallery_id'=>$request->topas_gallery_id,'title'=>$value,'image'=>$request->image[$key]]);
            }
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $topasChildGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(TopasChildGallery $topasChildGallery)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'TopasChildGallery Details', Response::HTTP_OK, new TopasChildGalleryResource($topasChildGallery));
        } else {
            return view('admin.topasChildGallery.show', compact('topasChildGallery'));
        }
    }

    public function edit(TobaSubGallery $topasChildGallery)
    {
        if (request()->is('api/*')) {
//            dd($topasChildGallery);
            return makeResponse('success', 'TopasChildGallery Details', Response::HTTP_OK, new TopasChildGalleryResource($topasChildGallery));
        } else {
            return view('admin.topasChildGallery.edit', compact('topasChildGallery'));
        }
    }

    public function update(TopasChildGalleryUpdateRequest $request, TopasChildGallery $topasChildGallery)
    {
        DB::beginTransaction();
        try {
            //($request->has('image') && $request->image != '' && $topasChildGallery->image != null && $topasChildGallery->image != '') ? unlink(public_path($topasChildGallery->image)) : '';
            if (
                $request->has('image') &&
                $request->image != '' &&
                $topasChildGallery->image != null &&
                $topasChildGallery->image != ''
            ) {
                $imagePath = public_path($topasChildGallery->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $topasChildGallery->update(collect($request->validated())->except('role')->all());
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $topasChildGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(TopasChildGallery $topasChildGallery)
    {
        $topasChildGallery->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }
}
