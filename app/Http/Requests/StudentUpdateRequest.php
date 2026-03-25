<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'picture' => ['nullable','string','max:255'],
            'pic' => ['nullable','string','max:255'],
            'name' => ['nullable','string','max:255'],
            'internship_year' => ['nullable','string','max:255'],
            'education' => ['nullable','string','max:255'],
            'service_attachment' => ['nullable','string','max:255'],
            'internship_training' => ['nullable','string','max:255'],
            'present_status' => ['nullable','string','max:255'],
        ];
    }
}
