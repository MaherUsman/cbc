<?php

namespace App\Services;

use App\Http\Requests\SecurityGalleryRequest;
use App\Models\Security;
use App\Models\SecurityGallery;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SecurityGalleryService
{
    public function index(Request $request, Security $security)
    {
        $securityGalleries = $security->securityGalleries()->orderBy('display_order', 'asc')->paginate(9); // Adjust items per page as needed

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.securityGallery.gallery_items', compact('securityGalleries'))->render(),
                'nextPageUrl' => $securityGalleries->nextPageUrl()
            ]);
        }

        return view('admin.securityGallery.index', compact('security', 'securityGalleries'));
    }


    public function create(Security $security)
    {
            return view('admin.securityGallery.createGallery', compact('security'));
    }

    public function store(SecurityGalleryRequest $request, Security $security)
    {
        DB::beginTransaction();
        try {
            //$securityGallery = SecurityGallery::create(collect($request->validated())->all());
            $securityGallery = $security->securityGalleries()->createMany($this->record($request));
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $securityGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(SecurityGallery $securityGallery)
    {
        return view('admin.securityGallery.show', compact('securityGallery'));
    }

    public function edit(SecurityGallery $securityGallery)
    {
        return view('admin.securityGallery.edit', compact('securityGallery'));
    }

    public function update(Request $request, SecurityGallery $securityGallery)
    {
        DB::beginTransaction();
        try {
            if (
                $request->has('image') &&
                $request->image != '' &&
                $securityGallery->image != null &&
                $securityGallery->image != ''
            ) {
                $imagePath = public_path($securityGallery->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $securityGallery->update(collect($request->all())->all());
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $securityGallery);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function destroy(SecurityGallery $securityGallery)
    {
        if (file_exists($securityGallery->image)) {
            unlink($securityGallery->image);
        }
        $securityGallery->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_OK);
    }

    public function getImageObjects(Security $security)
    {
        return view('admin.securityGallery.reorder', compact('security'));
    }

    public function updateOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->order as $key => $order) {
                SecurityGallery::where('id', $order)->update(['display_order' => $key + 1]);
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
