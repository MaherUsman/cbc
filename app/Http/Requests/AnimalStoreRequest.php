<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimalStoreRequest extends FormRequest
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
            'category_id' => ['required', 'integer'],
//            'image_thumbnail' => ['required', 'string', 'max:255'],
//            'image' => ['required', 'string', 'max:255'],
            'home_image' => ['required', 'string', 'max:255'],
            'home_image_thumbnail' => ['required', 'string', 'max:255'],
//            'banner_image' => ['required', 'string', 'max:255'],
//            'banner_image_thumbnail' => ['required', 'string', 'max:255'],
            'details' => ['required', 'string'],
            'show_on_top_bar' => ['required'],
            'is_amazing' => ['nullable', 'string'],
            'display_order' => ['nullable', 'integer'],
//            'prop_title.*' => ['required', 'string'], // Each item in prop_title must be a non-null string
//            'prop_details.*' => ['required', 'string'], // Each item in prop_details must be a non-null string
//            'status' => ['required'],
//            'display_order' => ['required', 'integer'],
        ];
    }
}
