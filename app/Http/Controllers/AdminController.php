<?php

namespace App\Http\Controllers;

use App\Helper\ImageUploadHelper;
use App\Http\Requests\AdminProfileUpdate;
use App\Http\Requests\AdminSettingUpdate;
use App\Models\Settings;
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

    public function setting()
    {
        $settings = Settings::first();
        return view('admin.settings.setting', compact('settings'));
    }

    public function update_setting(AdminSettingUpdate $request)
    {
        DB::beginTransaction();
        try {
            // Fetch the existing settings record (assuming you have only one settings row or you're fetching by some unique identifier)
            $settings = Settings::first(); // Fetch the first record

            $settingArray = [];

            // Check if a new image is uploaded or use the existing one
            $image = (ImageUploadHelper::checkUploadImage($request, 'logo', 'logo/', $settings)) ?: $settings->logo;
            $settingArray['logo'] = $image;

            // Add other settings if they exist in the request
            ($request->has('address') && $request->address != '') ? $settingArray['address'] = $request->address : '';
            ($request->has('phone') && $request->phone != '') ? $settingArray['phone'] = $request->phone : '';
            ($request->has('email') && $request->email != '') ? $settingArray['email'] = $request->email : '';
            ($request->has('zoo_map') && $request->zoo_map != '') ? $settingArray['zoo_map'] = $request->zoo_map : '';
            ($request->has('copyright_text') && $request->copyright_text != '') ? $settingArray['copyright_text'] = $request->copyright_text : '';
            ($request->has('copyright_link') && $request->copyright_link != '') ? $settingArray['copyright_link'] = $request->copyright_link : '';
            ($request->has('copyright_link_name') && $request->copyright_link_name != '') ? $settingArray['copyright_link_name'] = $request->copyright_link_name : '';

            // Check if settings record exists
            if ($settings) {
                // Update existing settings record
                $settings->update($settingArray);
            } else {
                // Create new settings record
                Settings::create($settingArray);
            }
//            $image = (ImageUploadHelper::checkUploadImage($request, 'logo', 'logo/', $settings)) ?: $settings->logo;
//            $settingArray = [];
//            $settingArray['logo'] = $image;
//            ($request->has('address') && $request->address != '') ? $settingArray['address'] = $request->address : '';
//            ($request->has('phone') && $request->phone != '') ? $settingArray['phone'] = $request->phone : '';
//            ($request->has('email') && $request->email != '') ? $settingArray['email'] = $request->email : '';
//            ($request->has('zoo_map') && $request->zoo_map != '') ? $settingArray['zoo_map'] = $request->zoo_map : '';
//            ($request->has('copyright_text') && $request->copyright_text != '') ? $settingArray['copyright_text'] = $request->copyright_text : '';
//            ($request->has('copyright_link') && $request->copyright_link != '') ? $settingArray['copyright_link'] = $request->copyright_link : '';
//            ($request->has('copyright_link_name') && $request->copyright_link_name != '') ? $settingArray['copyright_link_name'] = $request->copyright_link_name : '';
//            $settings->update($settingArray);
            DB::commit();
            $data = $settings;
            return makeResponse('success', 'Settings Updated Successfully!', Response::HTTP_OK, $data);
        } catch (\Exception $exception) {
            DB::rollBack();
            return makeResponse('error', 'error: ' . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
