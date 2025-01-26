<?php

namespace App\Http\Controllers;

use App\Http\Requests\TobaStoreRequest;
use App\Http\Requests\TobaUpdateRequest;
use App\Models\Toba;
use App\Services\TobaService;

class TobaController extends Controller
{
    public $tobaService;

    public function __construct(TobaService $tobaService)
    {
        $this->tobaService= $tobaService;
    }

    public function createOrEdit()
    {
        return $this->tobaService->createOrEdit();
    }

    public function store(TobaStoreRequest $request)
    {
        return $this->tobaService->store($request);
    }

    public function show(Toba $toba)
    {
        return $this->tobaService->show($toba);
    }

    public function update(TobaUpdateRequest $request, Toba $toba)
    {
        return $this->tobaService->update($request , $toba);
    }

    public function destroy(Toba $toba)
    {
        return $this->tobaService->destroy($toba);
    }
}
