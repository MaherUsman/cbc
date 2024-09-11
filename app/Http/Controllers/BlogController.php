<?php

namespace App\Http\Controllers;

use App\DataTables\BlogDataTable;
use App\Http\Requests\BlogStoreRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Models\Blog;
use App\Services\BlogService;

class BlogController extends Controller
{
    public $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService= $blogService;
    }

    public function index(BlogDataTable $dataTable)
    {
        return $this->blogService->index($dataTable);
    }

    public function create()
    {
        return $this->blogService->create();
    }

    public function store(BlogStoreRequest $request)
    {
        return $this->blogService->store($request);
    }

    public function show(Blog $blog)
    {
        //
    }

    public function edit(Blog $blog)
    {
        return $this->blogService->edit($blog);
    }

    public function update(BlogUpdateRequest $request, Blog $blog)
    {
        return $this->blogService->update($request , $blog);
    }

    public function destroy(Blog $blog)
    {
        return $this->blogService->destroy($blog);
    }
}
