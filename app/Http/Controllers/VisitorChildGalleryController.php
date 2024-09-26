<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitorChildGalleryStoreRequest;
use App\Http\Requests\VisitorChildGalleryUpdateRequest;
use App\Http\Resources\VisitorChildGalleryCollection;
use App\Http\Resources\VisitorChildGalleryResource;
use App\Models\AboutUsGallery;
use App\Models\VisitorChildGallery;
use App\Models\VisitorGallery;
use App\Services\VisitorChildGalleryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VisitorChildGalleryController extends Controller
{
    public $visitorChildGalleryService;

    public function __construct(VisitorChildGalleryService $visitorChildGalleryService)
    {
        $this->visitorChildGalleryService= $visitorChildGalleryService;
    }

    public function index(VisitorGallery $visitorGallery)
    {
        return $this->visitorChildGalleryService->index($visitorGallery);
    }

    public function create()
    {
        return $this->visitorChildGalleryService->create();
    }

    public function store(/*VisitorChildGalleryStore*/Request $request)
    {
        return $this->visitorChildGalleryService->store($request);
    }

    public function show(VisitorChildGallery $visitorChildGallery)
    {
        //
    }

    public function edit(VisitorChildGallery $visitorChildGallery)
    {
        return $this->visitorChildGalleryService->edit($visitorChildGallery);
    }

    public function update(VisitorChildGalleryUpdateRequest $request, VisitorChildGallery $visitorChildGallery)
    {
        return $this->visitorChildGalleryService->update($request , $visitorChildGallery);
    }

    public function destroy(VisitorChildGallery $visitorChildGallery)
    {
        return $this->visitorChildGalleryService->destroy($visitorChildGallery);
    }
}
