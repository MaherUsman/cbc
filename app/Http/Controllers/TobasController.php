<?php

namespace App\Http\Controllers;

use App\DataTables\TobasDataTable;
use App\Http\Requests\TobasStoreRequest;
use App\Http\Requests\TobasUpdateRequest;
use App\Http\Resources\TobasCollection;
use App\Http\Resources\TobasResource;
use App\Models\Tobas;
use App\Services\TobasService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TobasController extends Controller
{
    public $tobasService;

    public function __construct(TobasService $tobasService)
    {
        $this->tobasService= $tobasService;
    }

    public function index(TobasDataTable $dataTable)
    {
        return $this->tobasService->index($dataTable);
    }

    public function create()
    {
        return $this->tobasService->create();
    }

    public function store(TobasStoreRequest $request)
    {

        return $this->tobasService->store($request);
    }

    public function show(Tobas $tobas)
    {
        //
    }

    public function edit(Tobas $tobas)
    {
        return $this->tobasService->edit($tobas);
    }

    public function update(TobasUpdateRequest $request, Tobas $tobas)
    {
        return $this->tobasService->update($request , $tobas);
    }

    public function destroy(Tobas $tobas)
    {
        return $this->tobasService->destroy($tobas);
    }

    public function gridView()
    {
        return $this->tobasService->getImageObjects();
    }
    public function updateOrder(Request $request)
    {
        return $this->tobasService->updateOrder($request);
    }
}
