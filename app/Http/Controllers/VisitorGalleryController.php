<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitorGalleryStoreRequest;
use App\Http\Requests\VisitorGalleryUpdateRequest;
use App\Http\Resources\VisitorGalleryCollection;
use App\Http\Resources\VisitorGalleryResource;
use App\Models\VisitorGallery;
use App\Services\VisitorGalleryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VisitorGalleryController extends Controller
{
    public $visitorGalleryService;

    public function __construct(VisitorGalleryService $visitorGalleryService)
    {
        $this->visitorGalleryService= $visitorGalleryService;
    }

    public function index()
    {
        return $this->visitorGalleryService->index();
    }

    public function create()
    {
        return $this->visitorGalleryService->create();
    }

    public function store(/*VisitorGalleryStore*/Request $request)
    {
        return $this->visitorGalleryService->store($request);
    }

    public function show(VisitorGallery $visitorGallery)
    {
        //
    }

    public function edit(VisitorGallery $visitorGallery)
    {
        return $this->visitorGalleryService->edit($visitorGallery);
    }

    public function update(VisitorGalleryUpdateRequest $request, VisitorGallery $visitorGallery)
    {
        return $this->visitorGalleryService->update($request , $visitorGallery);
    }

    public function destroy(VisitorGallery $visitorGallery)
    {
        return $this->visitorGalleryService->destroy($visitorGallery);
    }
}
