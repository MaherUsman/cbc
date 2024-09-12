<?php

namespace App\Http\Controllers;

use App\DataTables\ContactUsDataTable;
use App\Http\Requests\ContactUsCreateRequest;
use App\Http\Requests\ContactUsUpdateRequest;
use App\Http\Resources\ContactUCollection;
use App\Http\Resources\ContactUResource;
use App\Models\ContactUs;
use App\Services\ContactUsService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactUsController extends Controller
{
    public $contactUsService;

    public function __construct(ContactUsService $contactUsService)
    {
        $this->contactUsService= $contactUsService;
    }

    public function index(ContactUsDataTable $dataTable)
    {
        return $this->contactUsService->index($dataTable);
    }

    public function create()
    {
        return $this->contactUsService->create();
    }

    public function store(ContactUsCreateRequest $request)
    {
        return $this->contactUsService->store($request);
    }

    public function destroy(ContactUs $contactUs)
    {
        return $this->contactUsService->destroy($contactUs);
    }
}
