<?php

namespace App\Services;

use App\Http\Requests\AboutUsGalleryStoreRequest;
use App\Http\Requests\AboutUsGalleryUpdateRequest;
use App\Http\Resources\AboutUsGalleryCollection;
use App\Http\Resources\AboutUsGalleryResource;
use App\Models\AboutUsGallery;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AboutUsGalleryService
{
    public function index()
    {
        $aboutUsGalleries = AboutUsGallery::all();
        return view('admin.aboutUsGallery.index', compact('aboutUsGalleries'));
    }

    public function getAboutUsGallery()
    {
        $aboutUsGalleries = AboutUsGallery::all();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new AboutUsGalleryCollection($aboutUsGalleries));
        } else {
            return view('admin.aboutUsGallery.index', compact('aboutUsGalleries'));
        }
    }

    public function create()
    {
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            return view('admin.aboutUsGallery.createGallery');
        }
    }

    public function store(/*AboutUsGalleryStore*/Request $request)
    {
        DB::beginTransaction();
        try {
//            dd($request->all());
            foreach ($request->title as $key=>$value){
                $aboutUsGallery = AboutUsGallery::create(['title'=>$value,
                    'image'=>$request->image[$key],
                    'thumb'=>$request->thumb,
                    'compressed'=>$request->compressed,
                ]);
            }
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $aboutUsGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(AboutUsGallery $aboutUsGallery)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'AboutUsGallery Details', Response::HTTP_OK, new AboutUsGalleryResource($aboutUsGallery));
        } else {
            return view('admin.aboutUsGallery.show', compact('aboutUsGallery'));
        }
    }

    public function edit(AboutUsGallery $aboutUsGallery)
    {
        if (request()->is('api/*')) {
//            dd($aboutUsGallery);
            return makeResponse('success', 'AboutUsGallery Details', Response::HTTP_OK, new AboutUsGalleryResource($aboutUsGallery));
        } else {
            return view('admin.aboutUsGallery.edit', compact('aboutUsGallery'));
        }
    }

    public function update(AboutUsGalleryUpdateRequest $request, AboutUsGallery $aboutUsGallery)
    {
        DB::beginTransaction();
        try {
            if ($request->has('image') && $request->image != '' && $aboutUsGallery->image != null && $aboutUsGallery->image != '') {
                $filePath = public_path($aboutUsGallery->image);
                if (File::exists($filePath)) {
                    unlink($filePath);
                }
            }
            $aboutUsGallery->update(collect($request->validated())->except('role')->all());
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $aboutUsGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(AboutUsGallery $aboutUsGallery)
    {
        $aboutUsGallery->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }
}
