<?php

namespace App\Http\Requests\Authentication;

use App\Rules\PasswordUpdateValidation;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class OtpCheckRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'otp' => ['required', new PasswordUpdateValidation($this->email, $this->otp,'OTP')],
//            'password' => ['required', 'min:8', 'confirmed', new PasswordUpdateValidation($this->email, $this->otp)],
        ];
    }

    public function messages()
    {
        return [
//            'password.confirmed' => 'Password Confirmation does not match!',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            makeResponse('error', $validator->errors()->first(), 422)
        );
    }
}
