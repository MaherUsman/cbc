<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        $commonRules = [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'username' => ['nullable', 'string', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'string', 'unique:users,phone'],
            'pic' => ['nullable', 'mimes:jpeg,jpg,png', 'max:2048'],
            'password' => ['required', 'confirmed', 'min:8'],
            'fcm_token' => ['nullable'],
        ];

        if (request()->is('api/*')) {
            return $commonRules;
        } else {
            return array_merge($commonRules, [
//                'role_id' => ['required', 'integer', 'exists:roles,id'],
                'role' => ['required', 'string', 'exists:roles,name'],
            ]);
        }
    }

    public function messages()
    {
        return [
            'pic.mimes' => 'Profile image must be of type: jpeg, jpg, png.',
            'pic.max' => 'Profile image must be smaller than :max kilobytes.',
            'username.string' => 'Username must be a string',
            'username.unique' => 'Username already exist try another one!',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            makeResponse('error', $validator->errors()->first(), 422)
        );
    }
}
