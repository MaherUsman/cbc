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
            'home_image' => ['required', 'string', 'max:255'],
            'home_image_thumbnail' => ['required', 'string', 'max:255'],
            'banner_image' => ['required', 'string', 'max:255'],
            'banner_image_thumbnail' => ['required', 'string', 'max:255'],
            'show_on_top_bar' => ['required', 'boolean'],
            'is_amazing' => ['nullable', 'string'],
            'display_order' => ['nullable', 'integer'],
//            'details' => ['required', 'string'],

            // Optional arrays — only validate if present
            'prop_title' => ['nullable', 'array'],
            'prop_title.*' => ['required_with:prop_title', 'string', 'max:255'],

            'prop_details' => ['nullable', 'array'],
            'prop_details.*' => ['required_with:prop_details', 'string'],

            'slider' => ['nullable', 'array'],
            'slider.*' => ['required_with:slider', 'string', 'max:255'],
        ];
    }

    protected function prepareForValidation()
    {
        // Ensure arrays are always present (even if empty)
        $this->merge([
            'prop_title' => $this->input('prop_title', []),
            'prop_details' => $this->input('prop_details', []),
            'slider' => $this->input('slider', []),
        ]);
    }
}
