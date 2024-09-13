<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderUpdateRequest extends FormRequest
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
            'slink' => ['required', 'string', 'max:255'],
            'details' => ['required', 'string', 'max:255'],
            'image' => ['required', 'string', 'max:255'],
//            'display_order' => ['required', 'integer'],
//            'status' => ['required'],
        ];
    }
}
