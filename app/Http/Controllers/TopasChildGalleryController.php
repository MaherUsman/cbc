<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopasChildGalleryStoreRequest;
use App\Http\Requests\TopasChildGalleryUpdateRequest;
use App\Http\Resources\TopasChildGalleryCollection;
use App\Http\Resources\TopasChildGalleryResource;
use App\Models\TobaSubGallery;
use App\Models\TopasChildGallery;
use App\Models\TopasGallery;
use App\Services\TopasChildGalleryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TopasChildGalleryController extends Controller
{
    public $topasChildGalleryService;

    public function __construct(TopasChildGalleryService $topasChildGalleryService)
    {
        $this->topasChildGalleryService= $topasChildGalleryService;
    }

    public function index(TopasGallery $topasGallery)
    {
        return $this->topasChildGalleryService->index($topasGallery);
    }

    public function create()
    {
        return $this->topasChildGalleryService->create();
    }

    public function store(/*TopasChildGalleryStore*/Request $request)
    {
        return $this->topasChildGalleryService->store($request);
    }

    public function show(TopasChildGallery $topasChildGallery)
    {
        //
    }

    public function edit($id)
    {
        $topasChildGallery = TobaSubGallery::find($id);
        return $this->topasChildGalleryService->edit($topasChildGallery);
    }

    public function update(TopasChildGalleryUpdateRequest $request, TopasChildGallery $topasChildGallery , $id)
    {
        return $this->topasChildGalleryService->update($request , $topasChildGallery);
    }

    public function destroy(TopasChildGallery $topasChildGallery)
    {
        return $this->topasChildGalleryService->destroy($topasChildGallery);
    }
}
