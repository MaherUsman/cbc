<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Helper\ImageUploadHelper;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index');
    }

    public function getUsers()
    {
        $users = User::all();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new UserCollection($users));
        } else {
            return view('admin.users.list', compact('users'));
        }
    }

    public function create()
    {
        $roles = Role::all();
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK, /*new UserCollection*/ ($roles));
        } else {
            return view('admin.users.create', compact('roles'));
        }
    }

    public function store(UserStoreRequest $request)
    {
//        dd($request->all());
        DB::beginTransaction();
        try {
            $image = ImageUploadHelper::checkUploadImage($request, 'pic', 'pic/');
            $user = User::create(collect($request->validated())->except('pic', 'role')->all() + ['pic' => $image]);
            $user->assignRole($request->role);
            DB::commit();
            return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $user);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(User $user)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'User Details', Response::HTTP_OK, new UserResource($user));
        } else {
            return view('admin.users.show', compact('user'));
        }
    }

    public function edit(User $user)
    {
        if (request()->is('api/*')) {
            return makeResponse('success', 'User Details', Response::HTTP_OK, new UserResource($user));
        } else {
            $roles = Role::all();
            return view('admin.users.edit', compact('user','roles'));
        }
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $image = ImageUploadHelper::checkUploadImage($request, 'pic', 'pic/')?: $user->pic;
            $user->update(collect($request->validated())->except('pic','role')->all() + ['pic' => $image]);
            $user->syncRoles([]);
            $user->assignRole($request->role);
            DB::commit();
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $user);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
    }
}
