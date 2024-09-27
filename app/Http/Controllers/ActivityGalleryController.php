<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityGalleryStoreRequest;
use App\Http\Requests\ActivityGalleryUpdateRequest;
use App\Http\Resources\ActivityGalleryCollection;
use App\Http\Resources\ActivityGalleryResource;
use App\Models\ActivityGallery;
use App\Services\ActivityGalleryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ActivityGalleryController extends Controller
{
    public $activityGalleryService;

    public function __construct(ActivityGalleryService $activityGalleryService)
    {
        $this->activityGalleryService= $activityGalleryService;
    }

    public function index()
    {
        return $this->activityGalleryService->index();
    }

    public function create()
    {
        return $this->activityGalleryService->create();
    }

    public function store(/*ActivityGalleryStore*/Request $request)
    {
        return $this->activityGalleryService->store($request);
    }

    public function show(ActivityGallery $activityGallery)
    {
        //
    }

    public function edit(ActivityGallery $activityGallery)
    {
        return $this->activityGalleryService->edit($activityGallery);
    }

    public function update(ActivityGalleryUpdateRequest $request, ActivityGallery $activityGallery)
    {
        return $this->activityGalleryService->update($request , $activityGallery);
    }

    public function destroy(ActivityGallery $activityGallery)
    {
        return $this->activityGalleryService->destroy($activityGallery);
    }
}
