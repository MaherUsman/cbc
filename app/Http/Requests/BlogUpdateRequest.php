<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogUpdateRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'image' => ['nullable', 'string'],
            'banner_image' => ['nullable', 'string'],
            'start_date' => ['required', 'string'],
            'time' => ['required', 'string'],
            'details' => ['required', 'string'],
            'address' => ['required', 'string'],
        ];
    }
}
