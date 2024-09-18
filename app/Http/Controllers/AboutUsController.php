<?php

namespace App\Http\Controllers;

use App\Http\Requests\AboutUsStoreRequest;
use App\Http\Requests\AboutUsUpdateRequest;
use App\Http\Resources\AboutUCollection;
use App\Http\Resources\AboutUResource;
use App\Models\AboutUs;
use App\Services\AboutUsService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AboutUsController extends Controller
{
    public $aboutUsService;

    public function __construct(AboutUsService $aboutUsService)
    {
        $this->aboutUsService= $aboutUsService;
    }

    public function createOrEdit()
    {
        return $this->aboutUsService->createOrEdit();
    }

    public function store(AboutUsStoreRequest $request)
    {
        return $this->aboutUsService->store($request);
    }

    public function show(AboutUs $aboutUs)
    {
        return $this->aboutUsService->show($aboutUs);
    }

    public function update(AboutUsUpdateRequest $request, AboutUs $aboutUs)
    {
        return $this->aboutUsService->update($request , $aboutUs);
    }

    public function destroy(AboutUs $aboutUs)
    {
        return $this->aboutUsService->destroy($aboutUs);
    }
}
