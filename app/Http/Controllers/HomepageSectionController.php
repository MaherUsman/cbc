<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomepageSectionStoreRequest;
use App\Http\Requests\HomepageSectionUpdateRequest;
use App\Models\HomepageSection;
use App\Services\HomepageSectionService;
use App\DataTables\HomepageSectionDataTable;

class HomepageSectionController extends Controller
{
    public $homepageSectionService;

    public function __construct(HomepageSectionService $homepageSectionService)
    {
        $this->homepageSectionService = $homepageSectionService;
    }

    public function index()
    {
        return $this->homepageSectionService->index();
    }

    public function create()
    {
        return $this->homepageSectionService->create();
    }

    public function store(HomepageSectionStoreRequest $request)
    {
        return $this->homepageSectionService->store($request);
    }

    public function destroy()
    {
        return $this->homepageSectionService->destroy();
    }
}
