<?php

namespace App\Http\Controllers;

use App\Http\Requests\TobaGalleryUpdateRequest;
use App\Models\TobaGallery;
use App\Services\TobaGalleryService;
use Illuminate\Http\Request;

class TobaGalleryController extends Controller
{
    public $tobaGalleryService;

    public function __construct(TobaGalleryService $tobaGalleryService)
    {
        $this->tobaGalleryService= $tobaGalleryService;
    }

    public function index()
    {
        return $this->tobaGalleryService->index();
    }

    public function create()
    {
        return $this->tobaGalleryService->create();
    }

    public function store(/*TobaGalleryStore*/Request $request)
    {
//        dd($request->all());
        return $this->tobaGalleryService->store($request);
    }

    public function show(TobaGallery $tobaGallery)
    {
        //
    }

    public function edit(TobaGallery $tobaGallery)
    {
        return $this->tobaGalleryService->edit($tobaGallery);
    }

    public function update(TobaGalleryUpdateRequest $request, TobaGallery $tobaGallery)
    {
        return $this->tobaGalleryService->update($request , $tobaGallery);
    }

    public function destroy(TobaGallery $tobaGallery)
    {
        return $this->tobaGalleryService->destroy($tobaGallery);
    }
}
