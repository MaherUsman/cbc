<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderAnimalStoreRequest extends FormRequest
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
            'title' => ['string', 'max:255'],
            'slink' => ['string', 'max:255'],
            'details' => ['string', 'max:255'],
            'image' => ['string', 'max:255'],
            'is_image' => ['boolean'],
//            'display_order' => ['nullable', 'required', 'integer'],
//            'status' => ['nullable', 'required'],
        ];
    }
}
