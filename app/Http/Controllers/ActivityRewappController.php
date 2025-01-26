<?php

namespace App\Http\Controllers;

use App\Http\Requests\RewampActivityUpdateRequest;
use App\Http\Requests\RewapActivityStoreRequest;
use App\Http\Requests\TobaStoreRequest;
use App\Http\Requests\TobaUpdateRequest;
use App\Models\Activity;
use App\Models\Toba;
use App\Services\ActivityRewampService;
use App\Services\TobaService;

class ActivityRewappController extends Controller
{
    public $tobaService;

    public function __construct(ActivityRewampService $tobaService)
    {
        $this->tobaService= $tobaService;
    }

    public function createOrEdit()
    {
        return $this->tobaService->createOrEdit();
    }

    public function store(RewapActivityStoreRequest $request)
    {
        return $this->tobaService->store($request);
    }

    public function show(Activity $toba)
    {
        return $this->tobaService->show($toba);
    }

    public function update(RewampActivityUpdateRequest $request, $id)
    {
        $activity = Activity::find($id);
        return $this->tobaService->update($request , $activity);
    }

    public function destroy(Activity $toba)
    {
        return $this->tobaService->destroy($toba);
    }
}
