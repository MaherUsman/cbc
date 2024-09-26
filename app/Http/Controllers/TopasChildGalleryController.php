<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopasChildGalleryStoreRequest;
use App\Http\Requests\TopasChildGalleryUpdateRequest;
use App\Http\Resources\TopasChildGalleryCollection;
use App\Http\Resources\TopasChildGalleryResource;
use App\Models\TopasChildGallery;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TopasChildGalleryController extends Controller
{
    public function index(Request $request)
    {
        $topasChildGalleries = TopasChildGallery::all();

        return new TopasChildGalleryCollection($topasChildGalleries);
    }

    public function store(TopasChildGalleryStoreRequest $request)
    {
        $topasChildGallery = TopasChildGallery::create($request->validated());

        return new TopasChildGalleryResource($topasChildGallery);
    }

    public function show(Request $request, TopasChildGallery $topasChildGallery)
    {
        return new TopasChildGalleryResource($topasChildGallery);
    }

    public function update(TopasChildGalleryUpdateRequest $request, TopasChildGallery $topasChildGallery)
    {
        $topasChildGallery->update($request->validated());

        return new TopasChildGalleryResource($topasChildGallery);
    }

    public function destroy(Request $request, TopasChildGallery $topasChildGallery)
    {
        $topasChildGallery->delete();

        return response()->noContent();
    }
}
