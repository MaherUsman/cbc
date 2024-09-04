<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService= $userService;
    }

    public function index(UsersDataTable $dataTable)
    {
        return $this->userService->index($dataTable);
    }

    public function create()
    {
        return $this->userService->create();
    }

    public function store(UserStoreRequest $request)
    {
        return $this->userService->store($request);
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        return $this->userService->edit($user);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        return $this->userService->update($request , $user);
    }

    public function destroy(User $user)
    {
        return $this->userService->destroy($user);
    }
}
