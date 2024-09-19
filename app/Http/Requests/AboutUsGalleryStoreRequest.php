<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutUsGalleryStoreRequest extends FormRequest
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
        return [
            'title' => ['nullable', 'array'], // The 'title' field is an array
            'title.*' => ['nullable', 'string', 'max:255'], // Each item in 'title[]' array should be a string and max 255 characters

            'image' => ['nullable', 'array'], // The 'image' field is an array
            'image.*' => ['nullable', 'string', 'max:255'], // Each item in 'image[]' array should be a string and max 255 characters

            //'status' => ['required', 'in:active,inactive'], // Example rule for 'status'
        ];
    }
}
