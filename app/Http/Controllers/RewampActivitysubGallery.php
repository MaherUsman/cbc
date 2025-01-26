<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityGallery;
use App\Models\ActivitySubGallery;
use App\Models\TobaGallery;
use App\Models\TobaSubGallery;
use App\Services\RewampActivitySubGalleryService;
use App\Services\TobaSubGalleryService;
use Illuminate\Http\Request;

class RewampActivitysubGallery extends Controller
{
    public $tobaSubGalleryService;

    public function __construct(RewampActivitySubGalleryService $tobaSubGalleryService)
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
        $tobaGallery = ActivityGallery::find($key);


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

    public function edit($id)
    {
        $activtySubGallery = ActivitySubGallery::find($id);
        return $this->tobaSubGalleryService->edit($activtySubGallery);
    }

    public function update(Request $request, $id)
    {
        $activityGallery = ActivitySubGallery::find($id);
        return $this->tobaSubGalleryService->update($request , $activityGallery);
    }

    public function destroy($id)
    {
        $activityGallery = ActivitySubGallery::find($id);
        return $this->tobaSubGalleryService->destroy($activityGallery);
    }
}
