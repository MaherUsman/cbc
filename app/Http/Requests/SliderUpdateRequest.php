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
        $isImage = $this->input('is_image') == 1; // Check if it's an image (is_image = 1)
        return [
            'slink' => $isImage ? ['required', 'string', 'max:255'] : ['nullable', 'string', 'max:255'], // Required for image, optional for video
            'details' => $isImage ? ['required', 'string'] : ['nullable', 'string'], // Required for image, optional for video
            'image' => ['required', 'string', 'max:255'],
            'is_image' => ['required', 'boolean'], // Required to indicate if it's an image or video
        ];
    }
}
