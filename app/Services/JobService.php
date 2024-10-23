<?php

namespace App\Services;

use App\DataTables\JobDataTable;
use App\Http\Requests\JobStoreRequest;
use App\Http\Requests\JobUpdateRequest;
use App\Http\Resources\JobCollection;
use App\Http\Resources\JobResource;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class JobService
{
    public function index(JobDataTable $dataTable)
    {
        return $dataTable->render('admin.job.index');
    }

    public function getJobs()
    {
        $jobs = Job::orderBy('display_order','asc')->get();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new JobCollection($jobs));
        } else {
            return view('admin.job.reorder', compact('jobs'));
        }
    }

    public function create()
    {
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            return view('admin.job.create');
        }
    }

    public function store(JobStoreRequest $request)
    {
        //dd($request->all());
        DB::beginTransaction();
        try {
            $job = Job::create(collect($request->validated())->all());
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $job);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Job $job)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'Job Details', Response::HTTP_OK, new JobResource($job));
        } else {
            return view('admin.job.show', compact('job'));
        }
    }

    public function edit(Job $job)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'Job Details', Response::HTTP_OK, new JobResource($job));
        } else {
            return view('admin.job.edit', compact('job'));
        }
    }

    public function update(JobUpdateRequest $request, Job $job)
    {
        DB::beginTransaction();
        try {
            ($request->has('image') && $request->image != '' && $job->image != null && $job->image != '') ? unlink(public_path($job->image)) : '';
            $job->update(collect($request->validated())->except('role')->all());
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $job);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->order as $key => $order) {
                Job::where('id', $order)->update(['display_order' => $key + 1]);
            }
            DB::commit();
            return makeResponse('success', 'Order Updated', 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }
}
