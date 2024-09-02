<?php

namespace App\Http\Controllers;

use App\Helper\ImageUploadHelper;
use App\Http\Requests\Admin\AffiliateRequest;
use App\Http\Requests\API\AffiliateAPIRequest;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\OtpCheckRequest;
use App\Http\Requests\Authentication\RegisterSubscriberRequest;
use App\Http\Requests\Authentication\RegisterVendorRequest;
use App\Http\Requests\Authentication\UpdatePasswordRequest;
use App\Http\Requests\SocialRegisterRequest;
use App\Http\Requests\UniqueEmailPhoneRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\Advisor;
use App\Models\GuestCustomer;
use App\Models\User;
use App\Services\AuthenticationService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    public $authService;

    public function __construct(AuthenticationService $service)
    {
        $this->authService = $service;
    }


    public function login(LoginRequest $request)
    {

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        Auth::logout(); // Use Auth::logout() instead of Session::flush()

        if ($request->remember_me) {
            $remember = true;
        } else {
            $remember = false;
        }
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            if (isset($request->fcm_token) && $request->fcm_token != '') {
                $user->fcm_token = $request->fcm_token;
                $user->save();
            }

            if ($user->hasRole('admin')) {
                $url = route('admin.dashboard');
            } else {
                $url = 'same_page';
            }

            $result = 'success';
            $message = 'Logged in Successfully';
            $token = $user->createToken('E-Commerce' . rand(0, 99999))->plainTextToken;
            $data = $this->authService->userResponse($user, $url);
            session(['user' => $data]);

            return makeResponse($result, $message, Response::HTTP_OK, $data, $token);
        } else {
            return makeResponse('error', 'Invalid Credentials', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function register(Request $request)
    {
        return $this->authService->register($request);
    }

    public function customerRegister(UserStoreRequest $request)
    {
        try {
            $user = User::create($request->validated() + ['role_id' => 3]);
            if (isset($request->fcm_token) && $request->fcm_token != '') {
                $user->fcm_token = $request->fcm_token;
                $user->save();
            }
            $token = $user->createToken('Psykee')->plainTextToken;
            $data = $this->authService->userResponse($user, 'same_page');
            return makeResponse('success', 'Customer Registered Successfully!', Response::HTTP_CREATED, $data, $token);
        } catch (\Exception $exception) {
            return makeResponse('error', 'error: ' . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function advisorRegister(Request $request)
    {
        DB::beginTransaction();
        try {
            $request = app('App\Http\Requests\UserStoreRequest');
            $image = ImageUploadHelper::checkUploadImage($request, 'profile_picture', 'profile_picture/');
            $user = User::create(collect($request->validated())->except('profile_picture')->all() + ['role_id' => 2, 'profile_picture' => $image]);
            if (isset($request->fcm_token) && $request->fcm_token != '') {
                $user->fcm_token = $request->fcm_token;
                $user->save();
            }
            $request = app('App\Http\Requests\AdvisorStoreRequest');
            $image = ImageUploadHelper::checkUploadImage($request, 'id_proof', 'id_proof/');
            $advisor = Advisor::create(collect($request->validated())
                    ->except('id_proof', 'category_id', 'tool_id', 'skill_id', 'language_id', 'username', 'dob')->all() +
                ['id_proof' => $image, 'user_id' => $user->id, 'start_date' => $request->experience]);
            $advisor->categories()->attach($request->category_id);
            $advisor->skills()->attach($request->skill_id);
            $advisor->tools()->attach($request->tool_id);
            $advisor->languages()->attach($request->language_id);
            DB::commit();
            $data = $this->authService->userResponse($user, 'same_page');
            $token = $user->createToken('Psykee')->plainTextToken;
            return makeResponse('success', 'Advisor Registered Successfully!', Response::HTTP_CREATED, $data, $token);
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage)) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message;
            }
            return makeResponse('error', $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function UserDetails()
    {
        return $this->authService->checkUserDetails();
    }

    public function verifyOTP(Request $request)
    {
        return $this->authService->VerifyOTP($request);
    }

    public function logout_web()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('adminLogin')->with('success', "Logout Successfully");
    }

    public function logout_api(Request $request)
    {
        Auth::user()->tokens()->delete();
        return makeResponse('success', 'Logout Successfully', 200);
    }

    public function forgot(Request $request)
    {
        return $this->authService->forgotPassword($request);
    }

    public function otpCheck(OtpCheckRequest $request)
    {
        return $this->authService->OtpCheck($request);
    }

    public function reset(UpdatePasswordRequest $request)
    {
        return $this->authService->resetPassword($request);
    }

    public function saveUser($request, $user, $type = 3)
    {
        if ($request->name) {
            $user->name = $request->name;
        }
        if ($request->email) {
            $user->email = $request->email;
        }
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        if ($request->provider) {
            $user->provider = $request->provider;
        }
        if ($request->provider_id) {
            $user->provider_id = $request->provider_id;
        }
        if ($request->fcm_token) {
            $user->fcm_token = $request->fcm_token;
        }
        $user->role_id = $type;
        $user->save();
        return $user;
    }

    public function UniqueEmailPhone(UniqueEmailPhoneRequest $request)
    {
        return makeResponse("success", "Email and Phone Number are Unique", Response::HTTP_OK);
    }
}
