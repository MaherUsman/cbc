<?php

namespace App\Services;

use App\DataTables\BlogDataTable;
use App\Http\Requests\BlogStoreRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Http\Resources\BlogCollection;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogService
{
    public function index(BlogDataTable $dataTable)
    {
        return $dataTable->render('admin.blog.index');
    }

    public function getBlogs()
    {
        $blogs = Blog::all();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new BlogCollection($blogs));
        } else {
            return view('admin.blog.index', compact('blogs'));
        }
    }

    public function create()
    {
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            return view('admin.blog.create');
        }
    }

    public function store(BlogStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['slug'] = $request->slug ? : Str::slug($request->title, '-');
//            dd($data);
            $blog = Blog::create($data);
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $blog);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Blog $blog)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'Blog Details', Response::HTTP_OK, new BlogResource($blog));
        } else {
            return view('admin.blog.show', compact('blog'));
        }
    }

    public function edit(Blog $blog)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'Blog Details', Response::HTTP_OK, new BlogResource($blog));
        } else {
            return view('admin.blog.edit', compact('blog'));
        }
    }

    public function update(BlogUpdateRequest $request, Blog $blog)
    {
        DB::beginTransaction();
        try {
//            dd($request->all());
            ($request->has('image') && $request->image != '' && $blog->image != null && $blog->image != '') ? unlink(public_path($blog->image)) : '';
            $blog->update(collect($request->validated())->except('role')->all());
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $blog);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }
}
