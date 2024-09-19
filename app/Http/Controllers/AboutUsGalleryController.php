<?php

namespace App\Http\Controllers;

use App\Http\Requests\AboutUsGalleryStoreRequest;
use App\Http\Requests\AboutUsGalleryUpdateRequest;
use App\Http\Resources\AboutUsGalleryCollection;
use App\Http\Resources\AboutUsGalleryResource;
use App\Models\AboutUsGallery;
use App\Services\AboutUsGalleryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AboutUsGalleryController extends Controller
{
    public $aboutUsGalleryService;

    public function __construct(AboutUsGalleryService $aboutUsGalleryService)
    {
        $this->aboutUsGalleryService= $aboutUsGalleryService;
    }

    public function index()
    {
        return $this->aboutUsGalleryService->index();
    }

    public function create()
    {
        return $this->aboutUsGalleryService->create();
    }

    public function store(/*AboutUsGalleryStore*/Request $request)
    {
        return $this->aboutUsGalleryService->store($request);
    }

    public function show(AboutUsGallery $aboutUsGallery)
    {
        //
    }

    public function edit(AboutUsGallery $aboutUsGallery)
    {
        return $this->aboutUsGalleryService->edit($aboutUsGallery);
    }

    public function update(AboutUsGalleryUpdateRequest $request, AboutUsGallery $aboutUsGallery)
    {
        return $this->aboutUsGalleryService->update($request , $aboutUsGallery);
    }

    public function destroy(AboutUsGallery $aboutUsGallery)
    {
        return $this->aboutUsGalleryService->destroy($aboutUsGallery);
    }
}
