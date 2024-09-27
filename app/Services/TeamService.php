<?php

namespace App\Services;

use App\DataTables\TeamDataTable;
use App\Http\Requests\TeamStoreRequest;
use App\Http\Requests\TeamUpdateRequest;
use App\Http\Resources\TeamCollection;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeamService
{
    public function index(TeamDataTable $dataTable)
    {
        return $dataTable->render('admin.team.index');
    }

    public function getTeams()
    {
        $teams = Team::all();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new TeamCollection($teams));
        } else {
            return view('admin.team.index', compact('teams'));
        }
    }

    public function create()
    {
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            return view('admin.team.create');
        }
    }

    public function store(TeamStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $team = Team::create($data);
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $team);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Team $team)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'Team Details', Response::HTTP_OK, new TeamResource($team));
        } else {
            return view('admin.team.show', compact('team'));
        }
    }

    public function edit(Team $team)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'Team Details', Response::HTTP_OK, new TeamResource($team));
        } else {
            return view('admin.team.edit', compact('team'));
        }
    }

    public function update(TeamUpdateRequest $request, Team $team)
    {
        DB::beginTransaction();
        try {
            ($request->has('image') && $request->image != '' && $team->image != null && $team->image != '') ? unlink(public_path($team->image)) : '';
            $team->update(collect($request->validated())->except('role')->all());
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $team);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Team $team)
    {
        $team->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }
}
