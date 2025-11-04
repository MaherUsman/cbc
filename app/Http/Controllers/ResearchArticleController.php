<?php

namespace App\Http\Controllers;

use App\DataTables\ResearchArticleDataTable;
use App\Http\Requests\ResearchArticleStoreRequest;
use App\Http\Requests\ResearchArticleUpdateRequest;
use App\Models\ResearchArticle;
use App\Services\ResearchArticleService;
use Illuminate\Http\Request;

class ResearchArticleController extends Controller
{
    public $researchArticleService;

    public function __construct(ResearchArticleService $researchArticleService)
    {
        $this->researchArticleService= $researchArticleService;
    }

//    public function index(ResearchArticleDataTable $dataTable)
    public function index()
    {
        return $this->researchArticleService->createOrEdit();
//        return $dataTable->render('admin.researchArticle.index');
    }

    public function create()
    {
        return view('admin.researchArticle.create');
    }

    public function store(ResearchArticleStoreRequest $request)
    {
        return $this->researchArticleService->store($request);
    }

    public function edit(ResearchArticle $researchArticle)
    {
        return view('admin.researchArticle.edit', compact('researchArticle'));
    }

    public function update(ResearchArticleUpdateRequest $request, ResearchArticle $researchArticle)
    {
        return $this->researchArticleService->update($request , $researchArticle);
    }

    public function destroy(ResearchArticle $researchArticle)
    {
        return $this->researchArticleService->destroy($researchArticle);
    }


    public function frontShow(ResearchArticle $researchArticle)
    {
        return view('frontend.researchArticleDetail', compact('researchArticle'));
    }
}
