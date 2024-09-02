<?php

namespace App\Http\Controllers;

use App\Helper\ImageUploadHelper;
use App\Http\Requests\AdminProfileUpdate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dash()
    {
        return view('admin.dashboard');
    }

    public function edit()
    {
        return view('admin.auth.profile');
    }

    public function update(AdminProfileUpdate $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $image = (ImageUploadHelper::checkUploadImage($request, 'pic', 'pic/', $user)) ?: $user->pic;
            $userArray = [];
            $userArray['pic'] = $image;
            ($request->has('first_name') && $request->first_name != '') ? $userArray['first_name'] = $request->first_name : '';
            ($request->has('last_name') && $request->last_name != '') ? $userArray['last_name'] = $request->last_name : '';
            ($request->has('username') && $request->username != '') ? $userArray['username'] = $request->username : '';
            ($request->has('email') && $request->email != '') ? $userArray['email'] = $request->email : '';
            ($request->has('password') && $request->password != '') ? $userArray['password'] = $request->password : '';
            $user->update($userArray);
            DB::commit();
            $data = $user;
            return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $data);
        } catch (\Exception $exception) {
            DB::rollBack();
            return makeResponse('error', 'error: ' . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
