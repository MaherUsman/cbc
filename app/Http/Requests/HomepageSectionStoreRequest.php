<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomepageSectionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // adjust if you want authorization logic
    }

    public function rules()
    {
        return [
            'title'            => ['nullable', 'string'],
            'content'          => ['nullable', 'string'],
            'background_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg'], // can be url or file path
            'button_text'      => ['nullable', 'string'],
            'button_link'      => ['nullable', 'string'], // url or route name
        ];
    }
}
