<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomepageSectionUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'            => ['nullable', 'string'],
            'content'          => ['nullable', 'string'],
            'background_image' => ['nullable', 'string'],
            'button_text'      => ['nullable', 'string'],
            'button_link'      => ['nullable', 'string'],
        ];
    }
}
