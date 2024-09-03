<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyOTPNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class AuthenticationService
{

    public function userResponse($user, $url = null)
    {
        $user->fresh();
        $data = [
            'user_id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'username' => $user->username,
            'phone' => $user->phone,
            'pic' => $user->pic,
            'url' => $url,
            'fcm_token' => $user->fcm_token,
        ];
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

    public function createUser($request)
    {
        DB::beginTransaction();
        try {

            $user = new User;
            $user->role_id = $request->role_id;
            $user->otp = EncryptedKey(6);
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
//            $token = Auth::user()->createToken('HoubaraFund')->plainTextToken;
//            return makeResponse($result, $message, $status, $data, $token);
            return makeResponse($result, $message, $status);
        } catch (\Exception $e) {
            DB::rollBack();
            return makeResponse('error', 'Error in Creating User: ' . $e->getMessage(), 500);
        }
    }

    public function saveRecord($model, $request)
    {
        try {
            $model->user_name = $request->user_name;
            $model->first_name = $request->first_name;
            $model->last_name = $request->last_name;
            $model->email = $request->email;
            if ($request->has('password') && $request->password != '') {
                $model->password = Hash::make($request->password);
            }
            if ($request->has('is_verified')) {
                $model->is_verified = $request->is_verified;
                if ($request->is_verified) {
                    $model->otp = null;
                }
            }
            $model->save();
            return $model;
        } catch (\Exception $e) {
            return ['error' => $e];
        }
    }

    public function sendEmail($user)
    {
        Notification::send($user, new VerifyOTPNotification($user));
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
            $otp = EncryptedKey(5);
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
        $user->otp = EncryptedKey();
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

        /* THIS PASSWORD WILL BE ENCRYPTED AS I HAVE USED SET */
        $user->password = $request->password;
        $user->save();
        return makeResponse('success', 'Password Updated Successfully now Login!', Response::HTTP_OK);
    }
}
