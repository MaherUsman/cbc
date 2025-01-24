<?php

namespace App\Http\Controllers;

use App\Models\TobaGallery;
use App\Models\TobaSubGallery;
use App\Services\TobaSubGalleryService;
use Illuminate\Http\Request;

class TobaSubGalleryController extends Controller
{
    public $tobaSubGalleryService;

    public function __construct(TobaSubGalleryService $tobaSubGalleryService)
    {
        $this->tobaSubGalleryService= $tobaSubGalleryService;
    }

    public function index(Request $request)
    {
        $queryParams = request()->query();
        $key = null;
        foreach ($queryParams as $key => $value) {
            $key = $key;
        }
        $tobaGallery = TobaGallery::find($key);

        return $this->tobaSubGalleryService->index($tobaGallery);
    }

    public function create()
    {
        return $this->tobaSubGalleryService->create();
    }

    public function store(/*TobaSubGalleryStore*/Request $request)
    {
//        dd($request->all());
        return $this->tobaSubGalleryService->store($request);
    }

    public function show(TobaSubGallery $tobaSubGallery)
    {
        //
    }

    public function edit(TobaSubGallery $tobaSubGallery)
    {
        return $this->tobaSubGalleryService->edit($tobaSubGallery);
    }

    public function update(Request $request, TobaSubGallery $tobaSubGallery)
    {
        return $this->tobaSubGalleryService->update($request , $tobaSubGallery);
    }

    public function destroy(TobaSubGallery $tobaSubGallery)
    {
        return $this->tobaSubGalleryService->destroy($tobaSubGallery);
    }
}
