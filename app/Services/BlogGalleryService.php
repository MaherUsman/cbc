<?php

namespace App\Services;

use App\Http\Requests\BlogGalleryStoreRequest;
use App\Http\Requests\BlogGalleryUpdateRequest;
use App\Http\Resources\BlogGalleryCollection;
use App\Http\Resources\BlogGalleryResource;
use App\Models\Blog;
use App\Models\BlogGallery;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BlogGalleryService
{
    public function index(Request $request, Blog $blog)
    {
        $blogGalleries = $blog->blogGalleries()->orderBy('display_order', 'asc')->paginate(9); // Adjust items per page as needed

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.blogGallery.gallery_items', compact('blogGalleries'))->render(),
                'nextPageUrl' => $blogGalleries->nextPageUrl()
            ]);
        }

        return view('admin.blogGallery.index', compact('blog', 'blogGalleries'));
    }


    public function create(Blog $blog)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            return view('admin.blogGallery.createGallery', compact('blog'));
        }
    }

    public function store(BlogGalleryStoreRequest $request, Blog $blog)
    {
        DB::beginTransaction();
        try {
            //$blogGallery = BlogGallery::create(collect($request->validated())->all());
            $blogGallery = $blog->blogGalleries()->createMany($this->record($request));
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $blogGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(BlogGallery $blogGallery)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'BlogGallery Details', Response::HTTP_OK, new BlogGalleryResource($blogGallery));
        } else {
            return view('admin.blogGallery.show', compact('blogGallery'));
        }
    }

    public function edit(BlogGallery $blogGallery)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'BlogGallery Details', Response::HTTP_OK, new BlogGalleryResource($blogGallery));
        } else {
            return view('admin.blogGallery.edit', compact('blogGallery'));
        }
    }

    public function update(Request $request, BlogGallery $blogGallery)
    {
        DB::beginTransaction();
        try {
            if (
                $request->has('image') &&
                $request->image != '' &&
                $blogGallery->image != null &&
                $blogGallery->image != ''
            ) {
                $imagePath = public_path($blogGallery->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
//            dd($request->all());
            $blogGallery->update(collect($request->all())->all());
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $blogGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function destroy(BlogGallery $blogGallery)
    {
        $blogGallery->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }

    public function getImageObjects(Blog $blog)
    {
        //$blogGalleries = $blog->blogGalleries; //BlogGallery::orderBy('display_order', 'asc')->get();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new BlogGalleryCollection($blog));
        } else {
            return view('admin.blogGallery.reorder', compact('blog'));
        }
    }

    public function updateOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->order as $key => $order) {
                BlogGallery::where('id', $order)->update(['display_order' => $key + 1]);
            }
            DB::commit();
            return makeResponse('success', 'Order Updated', 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function record(Request $request)
    {
        $gallery = [];
//        dd($request->all());
        foreach ($request->title as $key => $value) {
            $gallery[] = [
                'title' => $request->title[$key],
                'image' => $request->image[$key],
                'thumb' => $request->thumb[$key],
                'compressed' => $request->compressed[$key],
            ];
        }
        return $gallery;
    }
}
