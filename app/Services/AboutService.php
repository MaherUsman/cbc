<?php

namespace App\Services;

use App\DataTables\AboutDataTable;
use App\Http\Requests\AboutStoreRequest;
use App\Http\Requests\AboutUpdateRequest;
use App\Http\Resources\AboutCollection;
use App\Http\Resources\AboutResource;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AboutService
{
    public function index(AboutDataTable $dataTable)
    {
        return $dataTable->render('admin.about.index');
    }

    public function getAbouts()
    {
        $abouts = About::orderBy('display_order','asc')->get();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new AboutCollection($abouts));
        } else {
            return view('admin.about.reorder', compact('abouts'));
        }
    }

    public function create()
    {
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            return view('admin.about.create');
        }
    }

    public function store(AboutStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $about = About::create(collect($request->validated())->all());
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $about);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(About $about)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'About Details', Response::HTTP_OK, new AboutResource($about));
        } else {
            return view('admin.about.show', compact('about'));
        }
    }

    public function edit(About $about)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'About Details', Response::HTTP_OK, new AboutResource($about));
        } else {
            return view('admin.about.edit', compact('about'));
        }
    }

    public function update(AboutUpdateRequest $request, About $about)
    {
        DB::beginTransaction();
        try {
            if (
                $request->has('image') &&
                $request->image != '' &&
                $about->image != null &&
                $about->image != ''
            ) {
                $imagePath = public_path($about->image);

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $about->update(collect($request->validated())->except('role')->all());
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $about);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->order as $key => $order) {
                About::where('id', $order)->update(['display_order' => $key + 1]);
            }
            DB::commit();
            return makeResponse('success', 'Order Updated', 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(About $about)
    {
        $about->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }
}
