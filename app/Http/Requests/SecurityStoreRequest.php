<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SecurityStoreRequest extends FormRequest
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
            'banner_image' => 'required|string',
        ];

        return $rules;
    }
}
