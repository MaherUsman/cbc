<?php

namespace App\Services;

use App\DataTables\TobasDataTable;
use App\Http\Requests\TobasStoreRequest;
use App\Http\Requests\TobasUpdateRequest;
use App\Http\Resources\TobasCollection;
use App\Http\Resources\TobasResource;
use App\Models\Tobas;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TobasService
{
    public function index(TobasDataTable $dataTable)
    {
        return $dataTable->render('admin.tobas.index');
    }

    public function getTobass()
    {
        $tobas = Tobas::all();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new TobasCollection($tobas));
        } else {
            return view('admin.tobas.index', compact('tobas'));
        }
    }

    public function create()
    {
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            return view('admin.tobas.create');
        }
    }

    public function store(TobasStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $this->record($request);
            $tobas = Tobas::create($data['tobas']);

            DB::commit();
            return makeResponse('success', 'Added Successfully!', Response::HTTP_CREATED, $tobas);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Tobas $tobas)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'Tobas Details', Response::HTTP_OK, new TobasResource($tobas));
        } else {
            return view('admin.tobas.show', compact('tobas'));
        }
    }

    public function edit(Tobas $tobas)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'Tobas Details', Response::HTTP_OK, new TobasResource($tobas));
        } else {
            return view('admin.tobas.edit', compact('tobas'));
        }
    }

    public function update(TobasUpdateRequest $request, Tobas $tobas)
    {
        DB::beginTransaction();
        try {
            $data = $this->record($request);

            // Check if $data is not null
            if ($data !== null && isset($data['slider'])) {
                // Ensure each slider item is an associative array
                $data['slider'] = array_map(function ($imagePath) {
                    return ['image' => $imagePath];
                }, $data['slider']);
            }

            $tobas->update(collect($request->validated())->except('role')->all());

            // Remove previous props associated with the tobas
            $tobas->tobasProps()->where('tobas_id', $tobas->id)->delete();

            // Insert new props if they exist
            if (count($data['props']) > 0) {
                $tobas->tobasProps()->createMany($data['props']);
            }

            if ($data !== null && isset($data['slider'])) {
                if (count($data['slider']) > 0) {
                    $tobas->tobasSliders()->createMany($data['slider']);
                }
            }
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $tobas);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Tobas $tobas)
    {
        $tobas->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }

    private function record(Request $request)
    {
        $data = [];
        $data['tobas'] = [
            'title' => $request->title,
            'slug' => $request->slug?:Str::slug($request->title, '-'),
            'image' => $request->image,
            'details' => $request->details,
            'show_on_navbar' => $request->show_on_top_bar ?: 0
        ];
        return $data;
    }

    public function getImageObjects()
    {
        $tobas = Tobas::orderBy('display_order','asc')->get();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new TobasCollection($tobas));
        } else {
            return view('admin.tobas.reorder', compact('tobas'));
//            return view('admin.tobas.gallery', compact('tobas'));
        }
    }
    public function updateOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->order as $key => $order) {
                Tobas::where('id', $order)->update(['display_order' => $key + 1]);
            }
            DB::commit();
            return makeResponse('success', 'Order Updated', 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
