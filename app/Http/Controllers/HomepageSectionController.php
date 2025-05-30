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

    public function index(HomepageSectionDataTable $dataTable)
    {
        return $this->homepageSectionService->index($dataTable);
    }

    public function create()
    {
        return $this->homepageSectionService->create();
    }

    public function store(HomepageSectionStoreRequest $request)
    {
        return $this->homepageSectionService->store($request);
    }

    public function show(HomepageSection $homepageSection)
    {
        //
    }

    public function edit(HomepageSection $homepageSection)
    {
        return $this->homepageSectionService->edit($homepageSection);
    }

    public function update(HomepageSectionUpdateRequest $request, HomepageSection $homepageSection)
    {
        return $this->homepageSectionService->update($request, $homepageSection);
    }

    public function destroy(HomepageSection $homepageSection)
    {
        return $this->homepageSectionService->destroy($homepageSection);
    }
}
