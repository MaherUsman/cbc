<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TobaSubGalleryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'toba_gallery_id' => ['required', 'integer', 'exists:toba_galleries,id'],
            'title' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:255'],
        ];
    }
}
