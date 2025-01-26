<?php

namespace App\Services;

use App\Http\Requests\AboutUsGalleryStoreRequest;
use App\Http\Requests\AboutUsGalleryUpdateRequest;
use App\Http\Requests\TopasGalleryUpdateRequest;
use App\Http\Resources\AboutUsGalleryCollection;
use App\Http\Resources\AboutUsGalleryResource;
use App\Http\Resources\TopasGalleryCollection;
use App\Http\Resources\TopasGalleryResource;
use App\Models\AboutUsGallery;
use App\Models\Animal;
use App\Models\GalleriesContent;
use App\Models\Tobas;
use App\Models\TopasGallery;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TopasGalleryService
{
//    public function index()
//    {
//        $topasGalleries = TopasGallery::all();
//        $topasGalleriesContent = GalleriesContent::where('type', 'topas')->first();
//        return view('admin.topasGallery.index', compact('topasGalleries', 'topasGalleriesContent'));
//    }

    public function index($request, $tobas)
    {
        $tobasGalleries = $tobas->tobasGalleries()->paginate(9); // Adjust items per page as needed

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.tobasGallery.gallery_items', compact('tobasGalleries'))->render(),
                'nextPageUrl' => $tobasGalleries->nextPageUrl()
            ]);
        }

        return view('admin.topasGallery.index', compact('tobas', 'tobasGalleries'));
    }

    public function getTopasGallery()
    {
        $topasGalleries = TopasGallery::all();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new TopasGalleryCollection($topasGalleries));
        } else {
            return view('admin.topasGallery.index', compact('topasGalleries'));
        }
    }

    public function create($tobas)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            return view('admin.topasGallery.createGallery', compact('tobas'));
        }
    }

    public function store(/*TopasGalleryStore*/Request $request, Tobas $tobas)
    {
        DB::beginTransaction();
        try {
//            dd($request->all());
            $topasGallery = $tobas->tobasGalleries()->createMany($this->record($request));
//            foreach ($request->title as $key=>$value){
//                $topasGallery = TopasGallery::create(['title'=>$value,
//                    'image'=>$request->image[$key],
//                    'thumb'=>$request->thumb[$key],
//                    'compressed'=>$request->compressed[$key],]);
//            }
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $topasGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(TopasGallery $topasGallery)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'TopasGallery Details', Response::HTTP_OK, new TopasGalleryResource($topasGallery));
        } else {
            return view('admin.topasGallery.show', compact('topasGallery'));
        }
    }

    public function edit(TopasGallery $topasGallery)
    {
        if (request()->is('api/*')) {
//            dd($topasGallery);
            return makeResponse('success', 'TopasGallery Details', Response::HTTP_OK, new TopasGalleryResource($topasGallery));
        } else {
            return view('admin.topasGallery.edit', compact('topasGallery'));
        }
    }

    public function update(TopasGalleryUpdateRequest $request, TopasGallery $topasGallery)
    {
        DB::beginTransaction();
        try {

            if ($request->has('image') && $request->image != '' && $topasGallery->image != null && $topasGallery->image != '') {
                $filePath = public_path($topasGallery->image);
                if (File::exists($filePath)) {
                    unlink($filePath);
                }
            }
            $topasGallery->update(collect($request->validated())->except('role')->all());
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $topasGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(TopasGallery $topasGallery)
    {
        $topasGallery->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }

    private function record(Request $request)
    {
        $gallery = [];
//        dd($request->all());
        foreach ($request->title as $key => $value) {
            $gallery[] = [
                'title' => $request->title[$key],
                'image' => $request->image[$key],
                'thumb' => $request->thumb[$key],
                'compressed' => $request->compressed[$key],
            ];
        }
        return $gallery;
    }
}
