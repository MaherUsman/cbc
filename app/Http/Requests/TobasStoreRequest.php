<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TobasStoreRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'image' => ['required', 'string', 'max:255'],
            'details' => ['required', 'string'],
            'show_on_navbar' => ['required'],
        ];
    }
}
