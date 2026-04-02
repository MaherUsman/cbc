<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SecurityUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'banner_image' => 'nullable|string',
        ];

        return $rules;
    }
}
