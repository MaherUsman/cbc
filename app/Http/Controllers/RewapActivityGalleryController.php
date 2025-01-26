<?php

namespace App\Http\Controllers;

use App\Http\Requests\TobaGalleryUpdateRequest;
use App\Models\ActivityGallery;
use App\Models\TobaGallery;
use App\Services\RewampActivityGalleryService;
use App\Services\TobaGalleryService;
use Illuminate\Http\Request;

class RewapActivityGalleryController extends Controller
{
    public $tobaGalleryService;

    public function __construct(RewampActivityGalleryService $tobaGalleryService)
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

    public function edit($id)
    {
        $activityGallery = ActivityGallery::find($id);
        return $this->tobaGalleryService->edit($activityGallery);
    }

    public function update(TobaGalleryUpdateRequest $request, $id)
    {
        $activityGallery = ActivityGallery::find($id);
        return $this->tobaGalleryService->update($request , $activityGallery);
    }

    public function destroy($id)
    {
        $activityGallery = ActivityGallery::find($id);
        return $this->tobaGalleryService->destroy($activityGallery);
    }
}
