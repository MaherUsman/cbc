<?php

namespace App\Http\Controllers;

use App\DataTables\JobDataTable;
use App\Http\Requests\JobStoreRequest;
use App\Http\Requests\JobUpdateRequest;
use App\Models\Job;
use App\Services\JobService;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public $jobService;

    public function __construct(JobService $jobService)
    {
        $this->jobService= $jobService;
    }

    public function index(JobDataTable $dataTable)
    {
        return $this->jobService->index($dataTable);
    }

    public function gridView()
    {
        return $this->jobService->getJobs();
    }

    public function create()
    {
        return $this->jobService->create();
    }

    public function store(JobStoreRequest $request)
    {
        return $this->jobService->store($request);
    }

    public function show(Job $job)
    {
        //
    }

    public function edit(Job $job)
    {
        return $this->jobService->edit($job);
    }

    public function update(JobUpdateRequest $request, Job $job)
    {
        return $this->jobService->update($request , $job);
    }

    public function updateOrder(Request $request)
    {
        return $this->jobService->updateOrder($request);
    }

    public function destroy(Job $job)
    {
        return $this->jobService->destroy($job);
    }
}
