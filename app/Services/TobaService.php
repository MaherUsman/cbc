<?php

namespace App\Services;

use App\Http\Requests\TobaStoreRequest;
use App\Http\Requests\TobaUpdateRequest;
use App\Http\Resources\TobaResource;
use App\Models\Toba;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TobaService
{
    public function createOrEdit()
    {
        $toba = Toba::first();
        if ($toba) {
            return view('admin.toba.edit',compact('toba'));
        } else {
            return view('admin.toba.create');
        }
    }

    public function store(TobaStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $toba = Toba::create(collect($request->validated())->all());
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

    public function show(Toba $toba)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'Toba Details', Response::HTTP_OK, new TobaResource($toba));
        } else {
            return view('admin.toba.show', compact('toba'));
        }
    }

    public function update(TobaUpdateRequest $request, Toba $toba)
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
            $toba->update(collect($request->validated())->except('role')->all());
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $toba);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Toba $toba)
    {
        $toba->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }
}
