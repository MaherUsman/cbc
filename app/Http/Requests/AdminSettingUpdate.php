<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminSettingUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'zoo_map' => ['required', 'string', 'max:255', 'url'],
            'copyright_text' => ['required', 'string', 'max:255'],
            'copyright_link' => ['required', 'string', 'max:255'],
            'copyright_link_name' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:5120'],//jpeg,jpg,png,ico,bmp
            'home_count' => 'required|array|size:4', // Ensure it's an array with exactly 4 elements
            'home_count.*' => 'required|string',
        ];
    }
}
