<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutUsStoreRequest extends FormRequest
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
            'title' => ['nullable', 'string', 'max:255'],
            'p1' => ['nullable', 'string'],
            'p2' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            /*'status' => ['required'],*/
        ];
    }
}
