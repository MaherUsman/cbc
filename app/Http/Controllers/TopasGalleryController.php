<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopasGalleryStoreRequest;
use App\Http\Requests\TopasGalleryUpdateRequest;
use App\Http\Resources\TopasGalleryCollection;
use App\Http\Resources\TopasGalleryResource;
use App\Models\TopasGallery;
use App\Services\TopasGalleryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TopasGalleryController extends Controller
{
    public $topasGalleryService;

    public function __construct(TopasGalleryService $topasGalleryService)
    {
        $this->topasGalleryService= $topasGalleryService;
    }

    public function index()
    {
        return $this->topasGalleryService->index();
    }

    public function create()
    {
        return $this->topasGalleryService->create();
    }

    public function store(/*TopasGalleryStore*/Request $request)
    {
        return $this->topasGalleryService->store($request);
    }

    public function show(TopasGallery $topasGallery)
    {
        //
    }

    public function edit(TopasGallery $topasGallery)
    {
        return $this->topasGalleryService->edit($topasGallery);
    }

    public function update(TopasGalleryUpdateRequest $request, TopasGallery $topasGallery)
    {
        return $this->topasGalleryService->update($request , $topasGallery);
    }

    public function destroy(TopasGallery $topasGallery)
    {
        return $this->topasGalleryService->destroy($topasGallery);
    }
}
