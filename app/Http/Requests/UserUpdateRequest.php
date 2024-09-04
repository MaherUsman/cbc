<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
//        $this->dd($this->route()->user->id);
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'username' => ['required', 'string', Rule::unique('users', 'username')->ignore($this->route()->user->id)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->route()->user->id)],
            'phone' => ['required', 'string', Rule::unique('users', 'phone')->ignore($this->route()->user->id)],
//            'role_id' => ['required', 'integer', 'exists:roles,id'],
//            'pic' => ['nullable', 'mimes:jpeg,jpg,png'],
            'pic' => ['nullable', 'string'],
            'password' => ['nullable', 'confirmed', 'min:8'],//, 'password'
        ];
    }

    public function messages()
    {
        return [
            'pic.mimes' => 'Profile image must be of type: jpeg, png, jpg.',
            'pic.max' => 'Profile image must be smaller than :max kilobytes.',
            'username.string' => 'Username must be a string',
            'username.unique' => 'Username already exist try another one!'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            makeResponse('error', $validator->errors()->first(), 422)
        );
    }
}
