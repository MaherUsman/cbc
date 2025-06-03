<?php

namespace App\Services;

use App\Http\Requests\ResearchArticleGalleryRequest;
use App\Models\ResearchArticle;
use App\Models\ResearchArticleGallery;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ResearchArticleGalleryService
{
    public function index(Request $request, ResearchArticle $researchArticle)
    {
        $researchArticleGalleries = $researchArticle->researchArticleGalleries()->orderBy('display_order', 'asc')->paginate(9); // Adjust items per page as needed

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.researchArticleGallery.gallery_items', compact('researchArticleGalleries'))->render(),
                'nextPageUrl' => $researchArticleGalleries->nextPageUrl()
            ]);
        }

        return view('admin.researchArticleGallery.index', compact('researchArticle', 'researchArticleGalleries'));
    }


    public function create(ResearchArticle $researchArticle)
    {
            return view('admin.researchArticleGallery.createGallery', compact('researchArticle'));
    }

    public function store(ResearchArticleGalleryRequest $request, ResearchArticle $researchArticle)
    {
        DB::beginTransaction();
        try {
            //$researchArticleGallery = ResearchArticleGallery::create(collect($request->validated())->all());
            $researchArticleGallery = $researchArticle->researchArticleGalleries()->createMany($this->record($request));
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $researchArticleGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(ResearchArticleGallery $researchArticleGallery)
    {
        return view('admin.researchArticleGallery.show', compact('researchArticleGallery'));
    }

    public function edit(ResearchArticleGallery $researchArticleGallery)
    {
        return view('admin.researchArticleGallery.edit', compact('researchArticleGallery'));
    }

    public function update(Request $request, ResearchArticleGallery $researchArticleGallery)
    {
        DB::beginTransaction();
        try {
            if (
                $request->has('image') &&
                $request->image != '' &&
                $researchArticleGallery->image != null &&
                $researchArticleGallery->image != ''
            ) {
                $imagePath = public_path($researchArticleGallery->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
//            dd($request->all());
            $researchArticleGallery->update(collect($request->all())->all());
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $researchArticleGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function destroy(ResearchArticleGallery $researchArticleGallery)
    {
        if (file_exists($researchArticleGallery->image)) {
            unlink($researchArticleGallery->image);
        }
        $researchArticleGallery->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_OK);
    }

    public function getImageObjects(ResearchArticle $researchArticle)
    {
        return view('admin.researchArticleGallery.reorder', compact('researchArticle'));
    }

    public function updateOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->order as $key => $order) {
                ResearchArticleGallery::where('id', $order)->update(['display_order' => $key + 1]);
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
