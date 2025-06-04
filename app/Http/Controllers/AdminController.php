<?php

namespace App\Http\Controllers;

use App\DataTables\CareerApplicationDataTable;
use App\Helper\ImageUploadHelper;
use App\Http\Requests\AdminProfileUpdate;
use App\Http\Requests\AdminSettingUpdate;
use App\Http\Resources\CareerApplicationCollection;
use App\Models\ActivityGallery;
use App\Models\Animal;
use App\Models\Blog;
use App\Models\CareerApplication;
use App\Models\HomeCounter;
use App\Models\HomepageSection;
use App\Models\Settings;
use App\Models\Team;
use App\Models\VisitorGallery;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\SocialLinks;

class AdminController extends Controller
{
    public function dash()
    {
        $animals = Animal::count();
        $events = Blog::count();
        $activities = ActivityGallery::count();
        $visitors = VisitorGallery::count();
        $teams = Team::count();
        return view('admin.dashboard', compact('animals','events','activities','visitors','teams'));
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
        $homeCounter = HomeCounter::all();
        $socialLinks = SocialLinks::all();
        $homepageSection = HomepageSection::first();
        return view('admin.settings.setting', compact('settings', 'homeCounter', 'socialLinks', 'homepageSection'));
    }

    public function update_setting(AdminSettingUpdate $request)
    {
        DB::beginTransaction();
        try {

            //dd($request->all());
            // Fetch the existing settings record (assuming you have only one settings row or you're fetching by some unique identifier)
            $settings = Settings::first(); // Fetch the first record

            $settingArray = [];

            // Check if a new image is uploaded or use the existing one
            $image = (ImageUploadHelper::checkUploadImage($request, 'logo', 'logo/', $settings)) ?: $settings->logo;
            $settingArray['logo'] = $image;

            $homeCounterData = [
              'home_counter_name' => $request->home_counter_name,
              'home_count' => $request->home_count,
              'icon_class' => $request->icon_class,
            ];

            // Add other settings if they exist in the request
            ($request->has('Loading_page_text') && $request->Loading_page_text != '') ? $settingArray['Loading_page_text'] = $request->Loading_page_text : '';
            ($request->has('home_page_title') && $request->home_page_title != '') ? $settingArray['home_page_title'] = $request->home_page_title : '';
            ($request->has('address') && $request->address != '') ? $settingArray['address'] = $request->address : '';
            ($request->has('phone') && $request->phone != '') ? $settingArray['phone'] = $request->phone : '';
            ($request->has('email') && $request->email != '') ? $settingArray['email'] = $request->email : '';
            ($request->has('zoo_map') && $request->zoo_map != '') ? $settingArray['zoo_map'] = $request->zoo_map : '';
            ($request->has('copyright_text') && $request->copyright_text != '') ? $settingArray['copyright_text'] = $request->copyright_text : '';
            ($request->has('copyright_link') && $request->copyright_link != '') ? $settingArray['copyright_link'] = $request->copyright_link : '';
            ($request->has('copyright_link_name') && $request->copyright_link_name != '') ? $settingArray['copyright_link_name'] = $request->copyright_link_name : '';

            $settingArray['home_counter'] = $homeCounterData;
            // Check if settings record exists
            if ($settings) {
                // Update existing settings record
                $settings->update($settingArray);
            } else {
                // Create new settings record
                Settings::create($settingArray);
            }

            // Assume request contains 'social_links' => [
            //    'Facebook' => 'https://facebook.com/newlink',
            //    'Twitter' => 'https://twitter.com/newlink',
            //    ...
            // ]

            if ($request->has('social_links') && is_array($request->social_links)) {
                foreach ($request->social_links as $socialName => $socialUrl) {
                    // Validate url before updating if needed
                    if (filter_var($socialUrl, FILTER_VALIDATE_URL)) {
                        // Update only the social_link, social_name and social_icon remain fixed from seeder
                        SocialLinks::where('social_name', $socialName)
                            ->update(['social_link' => $socialUrl]);
                    }
                }
            }

            /* Save home page section title and image*/
            if ($request->has('background_image') || $request->has('title'))
            $section = HomepageSection::first();

            // Handle file upload
            if ($request->hasFile('background_image')) {
                $file = $request->file('background_image');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('homepage');

                // Create directory if it doesn't exist
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                // Delete old image if updating and old image exists
                if ($section && $section->background_image) {
                    $oldImagePath = public_path($section->background_image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Move new file
                $file->move($destinationPath, $filename);
                $data['background_image'] = 'homepage/' . $filename;
            }
            if ($request->has('title')) {
                $data['title'] = $request->title;
            }

            if ($section) {
                $section->update($data);
            } else {
                $section = HomepageSection::create($data);
            }
            /* Save home page section title and image*/

            DB::commit();

            $data = [
                'settings' => $settings,
                'social_links' => SocialLinks::all(), // return updated social links
            ];
            return makeResponse('success', 'Settings Updated Successfully!', Response::HTTP_OK, $data);
        } catch (\Exception $exception) {
            DB::rollBack();
            return makeResponse('error', 'error: ' . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function career_application(CareerApplicationDataTable $dataTable, $job_id=null)
    {
        if ($job_id) {
            $dataTable->setParameters($job_id);
        }
        return $dataTable->render('admin.career_application.index');
    }

    public function getCareerApplications()
    {
        $applications = CareerApplication::all();
        if (request()->is('api/*')) {
            return makeResponse('success', 'List', Response::HTTP_OK, new CareerApplicationCollection($applications));
        } else {
            return view('admin.career_application.index', compact('applications'));
        }
    }

}
