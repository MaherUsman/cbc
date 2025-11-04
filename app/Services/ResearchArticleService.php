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

    public function createOrEdit()
    {
        $researchArticle = ResearchArticle::first();
        if ($researchArticle) {
            return view('admin.researchArticle.edit',compact('researchArticle'));
        } else {
            return view('admin.researchArticle.create');
        }
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
        //dd($request->all());
//        if ($request->has('article_pdf_file')) {
//            $this->deleteImage($article->article_pdf_file);
//        }

        $article->update($request->all());
        return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $article);
    }

    public function destroy(ResearchArticle $article)
    {
        $this->deleteImage($article->banner_image);
        $this->deleteImage($article->article_pdf_file);
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
