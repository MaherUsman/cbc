<?php

namespace App\Http\Controllers;

use App\Models\AboutUsChildGallery;
use App\Models\AboutUsGallery;
use App\Services\AboutUsChildGalleryService;
use Illuminate\Http\Request;

class AboutUsChildGalleryController extends Controller
{
    public $aboutUsGalleryService;

    public function __construct(AboutUsChildGalleryService $aboutUsChildGalleryService)
    {
        $this->aboutUsChildGalleryService= $aboutUsChildGalleryService;
    }

    public function index(AboutUsGallery $aboutUsGallery)
    {
        return $this->aboutUsChildGalleryService->index($aboutUsGallery);
    }

    public function create()
    {
        return $this->aboutUsChildGalleryService->create();
    }

    public function store(/*AboutUsChildGalleryStore*/Request $request)
    {
        return $this->aboutUsChildGalleryService->store($request);
    }

    public function show(AboutUsChildGallery $aboutUsChildGallery)
    {
        //
    }

    public function edit(AboutUsChildGallery $aboutUsChildGallery)
    {
        return $this->aboutUsChildGalleryService->edit($aboutUsChildGallery);
    }

    public function update(AboutUsChildGalleryUpdateRequest $request, AboutUsChildGallery $aboutUsChildGallery)
    {
        return $this->aboutUsChildGalleryService->update($request , $aboutUsChildGallery);
    }

    public function destroy(AboutUsChildGallery $aboutUsChildGallery)
    {
        return $this->aboutUsChildGalleryService->destroy($aboutUsChildGallery);
    }
}
