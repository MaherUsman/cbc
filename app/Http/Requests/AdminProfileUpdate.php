<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdminProfileUpdate extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $id = Auth::id();
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ["email", "unique:users,email,$id", "max:255"],
            'password'=>['nullable','min:8','confirmed','max:255'],
            'pic' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:5120'],//jpeg,jpg,png,ico,bmp
        ];
    }

    public function messages()
    {
        return ['password.confirmed'=>'Confirmation Password does not match'];
    }
}
