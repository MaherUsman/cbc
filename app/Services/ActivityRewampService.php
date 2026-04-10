<?php

namespace App\Services;

use App\Http\Requests\RewampActivityUpdateRequest;
use App\Http\Requests\RewapActivityStoreRequest;
use App\Http\Requests\TobaStoreRequest;
use App\Http\Requests\TobaUpdateRequest;
use App\Http\Resources\TobaResource;
use App\Models\Activity;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ActivityRewampService
{
    public function createOrEdit()
    {
        $toba = Activity::first();
        if ($toba) {
            return view('admin.activity.edit',compact('toba'));
        } else {
            return view('admin.activity.create');
        }
    }

    public function store(RewapActivityStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = collect($request->validated())->all();
            if ($request->hasFile('banner_image')) {
                $file = $request->file('banner_image');
                $filename = time() . '_banner.' . $file->getClientOriginalExtension();
                $file->move('uploads/activity_galleries/', $filename);
                $data['banner_image'] = 'uploads/activity_galleries/' . $filename;
            }
            $toba = Activity::create($data);
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $toba);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Activity $toba)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'Toba Details', Response::HTTP_OK, new TobaResource($toba));
        } else {
            return view('admin.toba.show', compact('toba'));
        }
    }

    public function update(RewampActivityUpdateRequest $request, $toba)
    {
        DB::beginTransaction();
        try {
            if (
                $request->has('image') &&
                $request->image != '' &&
                $toba->image != null &&
                $toba->image != ''
            ) {
                $imagePath = public_path($toba->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $data = collect($request->validated())->except('role')->all();
            if ($request->hasFile('banner_image')) {
                $file = $request->file('banner_image');
                $filename = time() . '_banner.' . $file->getClientOriginalExtension();
                $file->move('uploads/activity_galleries/', $filename);
                $data['banner_image'] = 'uploads/activity_galleries/' . $filename;

                if ($toba->banner_image && file_exists(public_path($toba->banner_image))) {
                    unlink(public_path($toba->banner_image));
                }
            }
            $toba->update($data);
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $toba);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Activity $toba)
    {
        $toba->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }
}
