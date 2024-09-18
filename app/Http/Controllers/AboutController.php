<?php

namespace App\Http\Controllers;

use App\DataTables\AboutDataTable;
use App\Http\Requests\AboutStoreRequest;
use App\Http\Requests\AboutUpdateRequest;
use App\Models\About;
use App\Services\AboutService;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public $aboutService;

    public function __construct(AboutService $aboutService)
    {
        $this->aboutService= $aboutService;
    }

    public function index(AboutDataTable $dataTable)
    {
        return $this->aboutService->index($dataTable);
    }

    public function gridView()
    {
        return $this->aboutService->getAbouts();
    }

    public function create()
    {
        return $this->aboutService->create();
    }

    public function store(AboutStoreRequest $request)
    {
        return $this->aboutService->store($request);
    }

    public function show(About $about)
    {
        //
    }

    public function edit(About $about)
    {
        return $this->aboutService->edit($about);
    }

    public function update(AboutUpdateRequest $request, About $about)
    {
        return $this->aboutService->update($request , $about);
    }

    public function updateOrder(Request $request)
    {
        return $this->aboutService->updateOrder($request);
    }

    public function destroy(About $about)
    {
        return $this->aboutService->destroy($about);
    }
}
