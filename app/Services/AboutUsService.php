<?php

namespace App\Services;

use App\Http\Requests\AboutUsStoreRequest;
use App\Http\Requests\AboutUsUpdateRequest;
use App\Http\Resources\AboutUsResource;
use App\Models\AboutUs;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AboutUsService
{
    public function createOrEdit()
    {
        $aboutUs = AboutUs::first();
        if ($aboutUs) {
            return view('admin.aboutUs.edit',compact('aboutUs'));
        } else {
            return view('admin.aboutUs.create');
        }
    }

    public function store(AboutUsStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $aboutUs = AboutUs::create(collect($request->validated())->all());
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $aboutUs);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(AboutUs $aboutUs)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'AboutUs Details', Response::HTTP_OK, new AboutUsResource($aboutUs));
        } else {
            return view('admin.aboutUs.show', compact('aboutUs'));
        }
    }

    public function update(AboutUsUpdateRequest $request, AboutUs $aboutUs)
    {
        DB::beginTransaction();
        try {
            if (
                $request->has('image') &&
                $request->image != '' &&
                $aboutUs->image != null &&
                $aboutUs->image != ''
            ) {
                $imagePath = public_path($aboutUs->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $aboutUs->update(collect($request->validated())->except('role')->all());
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $aboutUs);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(AboutUs $aboutUs)
    {
        $aboutUs->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }
}
