<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResearchArticleGalleryRequest;
use App\Models\ResearchArticle;
use App\Models\ResearchArticleGallery;
use App\Services\ResearchArticleGalleryService;
use Illuminate\Http\Request;

class ResearchArticleGalleryController extends Controller
{
    public $researchArticleGalleryService;

    public function __construct(ResearchArticleGalleryService $researchArticleGalleryService)
    {
        $this->researchArticleGalleryService = $researchArticleGalleryService;
    }

    public function index(Request $request, ResearchArticle $researchArticle)
    {
        return $this->researchArticleGalleryService->index($request, $researchArticle);
    }

    public function gridView(ResearchArticle $researchArticle)
    {
        return $this->researchArticleGalleryService->getImageObjects($researchArticle);
    }

    public function create(ResearchArticle $researchArticle)
    {
        return $this->researchArticleGalleryService->create($researchArticle);
    }

    public function store(ResearchArticleGalleryRequest $request, ResearchArticle $researchArticle)
    {
        return $this->researchArticleGalleryService->store($request, $researchArticle);
    }

    public function show(ResearchArticleGallery $researchArticleGallery)
    {
        //
    }

    public function edit(ResearchArticleGallery $researchArticleGallery)
    {
        return $this->researchArticleGalleryService->edit($researchArticleGallery);
    }

    public function update(Request $request, ResearchArticleGallery $researchArticleGallery)
    {
        return $this->researchArticleGalleryService->update($request, $researchArticleGallery);
    }

    public function updateOrder(Request $request)
    {
        return $this->researchArticleGalleryService->updateOrder($request);
    }

    public function destroy(ResearchArticleGallery $researchArticleGallery)
    {
        return $this->researchArticleGalleryService->destroy($researchArticleGallery);
    }
}
