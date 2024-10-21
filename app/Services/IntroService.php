<?php

namespace App\Services;

use App\Http\Requests\IntroStoreRequest;
use App\Http\Requests\IntroUpdateRequest;
use App\Http\Resources\IntroResource;
use App\Models\Intro;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class IntroService
{
    public function createOrEdit()
    {
        $intro = Intro::first();
        if ($intro) {
            return view('admin.intro.edit',compact('intro'));
        } else {
            return view('admin.intro.create');
        }
    }

    public function store(IntroStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $intro = Intro::create(collect($request->validated())->all());
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $intro);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Intro $intro)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'Intro Details', Response::HTTP_OK, new IntroResource($intro));
        } else {
            return view('admin.intro.show', compact('intro'));
        }
    }

    public function update(IntroUpdateRequest $request, Intro $intro)
    {
        DB::beginTransaction();
        try {
            if (
                $request->has('image') &&
                !empty($request->image) &&
                !empty($intro->image) &&
                file_exists(public_path($intro->image))
            ) {
                try {
                    unlink(public_path($intro->image));
                } catch (\Exception $e) {
                    // Log the exception or handle the error
                    Log::error('Error deleting image: ' . $e->getMessage());
                }
            }
            $intro->update(collect($request->validated())->except('role')->all());
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $intro);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Intro $intro)
    {
        $intro->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }
}
