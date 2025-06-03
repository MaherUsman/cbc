<?php

namespace App\Services;

use App\Http\Requests\ResearchArticleStoreRequest;
use App\Http\Requests\ResearchArticleUpdateRequest;
use App\Models\ResearchArticle;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ResearchArticleService
{
    public function getArticleById($id)
    {
        return ResearchArticle::findOrFail($id);
    }

    public function store(ResearchArticleStoreRequest $request)
    {
        $researchArticle= ResearchArticle::create($request->all());
        return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $researchArticle);
    }

    public function update(ResearchArticleUpdateRequest $request, ResearchArticle $article)
    {
        if ($request->has('banner_image')) {
            $this->deleteImage($article->banner_image);
        }

        $article->update($request->all());
        return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $article);
    }

    public function destroy(ResearchArticle $article)
    {
        $this->deleteImage($article->banner_image);
        foreach ($article->galleries as $gallery) {
            $this->deleteImage($gallery->image);
            $gallery->delete();
        }
        $article->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_OK);
    }

    protected function deleteImage($imagePath)
    {
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
}
