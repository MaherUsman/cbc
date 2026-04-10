<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RewapActivityStoreRequest extends FormRequest
{
    /**
     * Determine if  the user is authorized to make this request.
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
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'banner_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
        ];
    }
}
