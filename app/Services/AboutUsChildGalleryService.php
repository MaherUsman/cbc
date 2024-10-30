<?php

namespace App\Services;

use App\Http\Requests\AboutUsChildGalleryUpdateRequest;
use App\Http\Resources\AboutUsChildGalleryCollection;
use App\Models\AboutUsChildGallery;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AboutUsChildGalleryService
{
    public function index($aboutUsGallery)
    {
        $aboutUsChildGalleries = AboutUsChildGallery::where('about_us_gallery_id', $aboutUsGallery->id)->get();
        return view('admin.aboutUsChildGallery.index', compact('aboutUsChildGalleries','aboutUsGallery'));
    }

    public function getAboutUsChildGallery()
    {
        $aboutUsChildGalleries = AboutUsChildGallery::all();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new AboutUsChildGalleryCollection($aboutUsChildGalleries));
        } else {
            return view('admin.aboutUsChildGallery.index', compact('aboutUsChildGalleries'));
        }
    }

    public function create()
    {
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            return view('admin.aboutUsChildGallery.createGallery');
        }
    }

    public function store(/*AboutUsChildGalleryStore*/Request $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->title as $key=>$value){
                $aboutUsChildGallery = AboutUsChildGallery::create(['about_us_gallery_id'=>$request->about_us_gallery_id,
                    'title'=>$value,
                    'image'=>$request->image[$key],
                    'thumb'=>$request->thumb,
                    'compressed'=>$request->compressed,
                ]);
            }
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $aboutUsChildGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(AboutUsChildGallery $aboutUsChildGallery)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'AboutUsChildGallery Details', Response::HTTP_OK, new AboutUsChildGalleryResource($aboutUsChildGallery));
        } else {
            return view('admin.aboutUsChildGallery.show', compact('aboutUsChildGallery'));
        }
    }

    public function edit(AboutUsChildGallery $aboutUsChildGallery)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'AboutUsChildGallery Details', Response::HTTP_OK, new AboutUsChildGalleryResource($aboutUsChildGallery));
        } else {
            return view('admin.aboutUsChildGallery.edit', compact('aboutUsChildGallery'));
        }
    }

    public function update(Request $request, AboutUsChildGallery $aboutUsChildGallery)
    {
        DB::beginTransaction();
        try {
//            dd($request->all());
            if ($request->has('image') && $request->image != '' && $aboutUsChildGallery->image != null && $aboutUsChildGallery->image != '') {
                $filePath = public_path($aboutUsChildGallery->image);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            $aboutUsChildGallery->update(collect($request->all())->except('role')->all());
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $aboutUsChildGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(AboutUsChildGallery $aboutUsChildGallery)
    {
        $aboutUsChildGallery->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }
}
