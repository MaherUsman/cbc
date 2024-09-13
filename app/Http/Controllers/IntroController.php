<?php

namespace App\Http\Controllers;

use App\Http\Requests\IntroStoreRequest;
use App\Http\Requests\IntroUpdateRequest;
use App\Http\Resources\IntroCollection;
use App\Http\Resources\IntroResource;
use App\Models\Intro;
use App\Services\IntroService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IntroController extends Controller
{
    public $introService;

    public function __construct(IntroService $introService)
    {
        $this->introService= $introService;
    }

    public function createOrEdit()
    {
        return $this->introService->createOrEdit();
    }

    public function store(IntroStoreRequest $request)
    {
        return $this->introService->store($request);
    }

    public function show(Intro $intro)
    {
        return $this->introService->show($intro);
    }

    public function update(IntroUpdateRequest $request, Intro $intro)
    {
        return $this->introService->update($request , $intro);
    }

    public function destroy(Intro $intro)
    {
        return $this->introService->destroy($intro);
    }
}
