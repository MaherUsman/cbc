<?php

namespace App\Http\Controllers;

use App\DataTables\TeamDataTable;
use App\Http\Requests\TeamStoreRequest;
use App\Http\Requests\TeamUpdateRequest;
use App\Http\Resources\TeamCollection;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use App\Services\TeamService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TeamController extends Controller
{
    public $teamService;

    public function __construct(TeamService $teamService)
    {
        $this->teamService= $teamService;
    }

    public function index(TeamDataTable $dataTable)
    {
        return $this->teamService->index($dataTable);
    }

    public function create()
    {
        return $this->teamService->create();
    }

    public function store(TeamStoreRequest $request)
    {
        return $this->teamService->store($request);
    }

    public function show(Team $team)
    {
        //
    }

    public function edit(Team $team)
    {
        return $this->teamService->edit($team);
    }

    public function update(TeamUpdateRequest $request, Team $team)
    {
        return $this->teamService->update($request , $team);
    }

    public function destroy(Team $team)
    {
        return $this->teamService->destroy($team);
    }
}
