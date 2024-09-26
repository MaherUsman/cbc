<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitorChildGalleryStoreRequest;
use App\Http\Requests\VisitorChildGalleryUpdateRequest;
use App\Http\Resources\VisitorChildGalleryCollection;
use App\Http\Resources\VisitorChildGalleryResource;
use App\Models\VisitorChildGallery;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VisitorChildGalleryController extends Controller
{
    public function index(Request $request)
    {
        $visitorChildGalleries = VisitorChildGallery::all();

        return new VisitorChildGalleryCollection($visitorChildGalleries);
    }

    public function store(VisitorChildGalleryStoreRequest $request)
    {
        $visitorChildGallery = VisitorChildGallery::create($request->validated());

        return new VisitorChildGalleryResource($visitorChildGallery);
    }

    public function show(Request $request, VisitorChildGallery $visitorChildGallery)
    {
        return new VisitorChildGalleryResource($visitorChildGallery);
    }

    public function update(VisitorChildGalleryUpdateRequest $request, VisitorChildGallery $visitorChildGallery)
    {
        $visitorChildGallery->update($request->validated());

        return new VisitorChildGalleryResource($visitorChildGallery);
    }

    public function destroy(Request $request, VisitorChildGallery $visitorChildGallery)
    {
        $visitorChildGallery->delete();

        return response()->noContent();
    }
}
