<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopasGalleryStoreRequest;
use App\Http\Requests\TopasGalleryUpdateRequest;
use App\Http\Resources\TopasGalleryCollection;
use App\Http\Resources\TopasGalleryResource;
use App\Models\TopasGallery;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TopasGalleryController extends Controller
{
    public function index(Request $request)
    {
        $topasGalleries = TopasGallery::all();

        return new TopasGalleryCollection($topasGalleries);
    }

    public function store(TopasGalleryStoreRequest $request)
    {
        $topasGallery = TopasGallery::create($request->validated());

        return new TopasGalleryResource($topasGallery);
    }

    public function show(Request $request, TopasGallery $topasGallery)
    {
        return new TopasGalleryResource($topasGallery);
    }

    public function update(TopasGalleryUpdateRequest $request, TopasGallery $topasGallery)
    {
        $topasGallery->update($request->validated());

        return new TopasGalleryResource($topasGallery);
    }

    public function destroy(Request $request, TopasGallery $topasGallery)
    {
        $topasGallery->delete();

        return response()->noContent();
    }
}
