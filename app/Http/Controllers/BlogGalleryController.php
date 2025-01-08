<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogGalleryStoreRequest;
use App\Http\Requests\BlogGalleryUpdateRequest;
use App\Models\Blog;
use App\Models\BlogGallery;
use App\Services\BlogGalleryService;
use Illuminate\Http\Request;

class BlogGalleryController extends Controller
{
    public $blogGalleryService;

    public function __construct(BlogGalleryService $blogGalleryService)
    {
        $this->blogGalleryService = $blogGalleryService;
    }

    public function index(Request $request, Blog $blog)
    {
        return $this->blogGalleryService->index($request, $blog);
    }

    public function gridView(Blog $blog)
    {
        return $this->blogGalleryService->getImageObjects($blog);
    }

    public function create(Blog $blog)
    {
        return $this->blogGalleryService->create($blog);
    }

    public function store(BlogGalleryStoreRequest $request, Blog $blog)
    {
        return $this->blogGalleryService->store($request, $blog);
    }

    public function show(BlogGallery $blogGallery)
    {
        //
    }

    public function edit(BlogGallery $blogGallery)
    {
        return $this->blogGalleryService->edit($blogGallery);
    }

    public function update(Request $request, BlogGallery $blogGallery)
    {
        return $this->blogGalleryService->update($request, $blogGallery);
    }

    public function updateOrder(Request $request)
    {
        return $this->blogGalleryService->updateOrder($request);
    }

    public function destroy(BlogGallery $blogGallery)
    {
        return $this->blogGalleryService->destroy($blogGallery);
    }
}
