<?php

namespace App\Services;


use App\Models\Affiliate;
use App\Models\User;
use App\Models\Vendor;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyOTPNotification;
use App\Traits\AffiliateTrait;
use App\Traits\UserResponseTrait;
use App\Traits\VendorTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use function NunoMaduro\Collision\Exceptions\getMessage;

class AuthenticationService
{

    public function userResponse($user, $url = null)
    {
        $user->fresh();
        $data = [
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'profile_picture' => $user->profile_picture,
            'country_code' => $user->country_code,
            'mobile_number' => $user->mobile_number,
            'username' => $user->username,
            'dob' => $user->dob,
            'url' => $url,
            'role_id' => $user->role_id,
            'fcm_token' => $user->fcm_token,
        ];
        if ($user->role_id == 2) {
            $data['advisor'] = $user->advisor;
            $data['advisor']['categories'] = $user->advisor->categories;
            $data['advisor']['skills'] = $user->advisor->skills;
            $data['advisor']['tools'] = $user->advisor->tools;
            $data['advisor']['languages'] = $user->advisor->languages;
        }
        return $data;
    }

    public function checkUserDetails()
    {
        try {
            $url = 'same_page';
            $data = $this->userResponse(Auth::user(), $url);
            return makeResponse('success', 'Logged In User Details.', Response::HTTP_OK, $data);
        } catch (\Exception $exception) {
            return makeResponse('error', $exception, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function createCustomer($request)
    {
        DB::beginTransaction();
        try {

//            $otp = Hash::make(rand(10000000, 99999999));
//            $otp = substr($otp, 7, 28);
            $user = new User;
            $user->role_id = $request->role_id;
//            $user->otp = $otp;
            $saveResponse = $this->saveRecord($user, $request);
            if (isset($saveResponse['error'])) {
                return makeResponse('error', 'Error in Saving User: ' . $saveResponse['error'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            if ($request->isMethod('post')) {
                $status = Response::HTTP_CREATED;
            } else {
                $status = Response::HTTP_OK;
            }
            DB::commit();
            if ($request->email) {
                try {
                    $this->sendEmail($saveResponse);
                } catch (\Exception $e) {
                    return makeResponse('error', 'Error in Sending Email to User: ' . $e, Response::HTTP_INTERNAL_SERVER_ERROR);
                }
            }
//            Auth::loginUsingId($user->id, 'true');
            $result = 'success';
//            $message = 'Registered Successfully!';
            $message = 'Verify Email to login!';
//            $data = $this->userResponse(Auth::user());
//            $token = Auth::user()->createToken('HarryFox')->plainTextToken;
//            return makeResponse($result, $message, $status, $data, $token);
            return makeResponse($result, $message, $status);
        } catch (\Exception $e) {
            DB::rollBack();
            return makeResponse('error', 'Error in Creating User: ' . $e->getMessage(), 500);
        }
    }

    public function sendEmail($user)
    {
//        Notification::send($user, new VerifyOTPNotification($user));
    }

    public function VerifyOTP($request)
    {
        DB::beginTransaction();
        $user = User::where('otp', $request->otp)->first();

        if ($user) {
            $user->is_verified = 1;
            $user->otp = null;
            $user->save();
            DB::commit();

            Auth::loginUsingId($user->id, 'true');
            session()->flash('message', 'Email Verified now login');
            return redirect('/login');
        }
        DB::rollBack();
        return makeResponse("error", "Verification Link Expired", Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function forgotPassword($request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return makeResponse('error', 'No Such User email exist ', 404);
        }
        DB::beginTransaction();
        try {
//            $otp = Hash::make(rand(10000000, 99999999));
            $encString = EncryptedKey();
            $otp = substr($encString, -5);
            $user->otp = $otp;
            $user->save();
            if ($request->email) {
                try {
                    $this->sendResetEmail($user);
                } catch (\Exception $e) {
                    return makeResponse('error', 'Error in Sending Reset Password Email: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
                }
            }
            DB::commit();
            $result = 'success';
            $message = 'Reset Password Link Send, Check your email!';
            return makeResponse($result, $message, Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return makeResponse('error', 'Error in Reset Password Request: ' . $e->getMessage(), 500);
        }
    }

    public function sendResetEmail($user)
    {
        Notification::send($user, new ResetPasswordNotification($user));
    }

    public function OtpCheck($request)
    {
        $user = User::where('email', $request->email)->where('otp', $request->otp)->first();
        if (!$user) {
            return makeResponse('error', 'Token Expired!', Response::HTTP_UNAUTHORIZED);
        }
        $otp = EncryptedKey();
        $user->otp = $otp;
        $user->save();
        $validated=['secure_key'=>$user->otp,'email'=>$user->email];
        return makeResponse('success', 'OTP verified!', Response::HTTP_OK,$validated);
    }

    public function resetPassword($request)
    {
        $user = User::where('email', $request->email)->where('otp', $request->secure_key)->first();
        if (!$user) {
            return makeResponse('error', 'Token Expired!', Response::HTTP_UNAUTHORIZED);
        }
//        $user->password = Hash::make($request->password);
        $user->password = $request->password;
        $user->save();
        return makeResponse('success', 'Password Updated Successfully now Login!', Response::HTTP_OK);
    }
}
