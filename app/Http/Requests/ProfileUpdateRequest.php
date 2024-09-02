<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
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
        $commonRules = [
            'name' => ['sometimes', 'required', 'string'],
            'profile_picture' => ['nullable', 'mimes:jpeg,jpg,png', 'max:2048'],
            'password' => ['nullable', 'confirmed'],
            'image' => ['nullable', 'array'],
            'image.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'username' => ['nullable', 'string', Rule::unique('users', 'username')->ignore($this->user()->id)],//'unique:users,username'
            'dob' => ['nullable', 'date'],
            'country_code' => ['sometimes', 'required', 'string'],
            'mobile_number' => ['sometimes', 'required', 'string', Rule::unique('users', 'mobile_number')->ignore($this->user()->id)],
        ];
        # TODO this role id check is not working fix it to update Advisor Profile
        if ($this->user()->role_id == 2) {
            return array_merge($commonRules, [
                'id_proof' => ['nullable', 'mimes:jpeg,jpg,png'],
                'bio' => ['nullable', 'string'],
                'sub_title' => ['nullable', 'string'],
                'short_bio' => ['nullable', 'string'],
                'experience' => ['sometimes', 'required', 'integer'],
                'per_min_charge' => ['sometimes', 'required', 'string'],
                'status' => ['sometimes', 'required', 'integer', 'in:0,1'],
                'available' => ['sometimes', 'required', 'integer', 'in:0,1'],
                'category_id' => ['sometimes', 'required', 'array'],
                'category_id.*' => ['integer', 'exists:categories,id'],
                'skill_id' => ['sometimes', 'required', 'array'],
                'skill_id.*' => ['integer', 'exists:skills,id'],
                'tool_id' => ['sometimes', 'required', 'array'],
                'tool_id.*' => ['integer', 'exists:tools,id'],
            ]);
        } else {
            return $commonRules;
        }
    }

    public function messages()
    {
        return [
            'image.array' => 'The images field must be an array.',
            'image.*.image' => 'Each item in the images array must be an image.',
            'image.*.mimes' => 'Each image must be of type: jpeg, png, jpg, gif.',
            'image.*.max' => 'Each image must be smaller than :max kilobytes.',
            'profile_picture.mimes' => 'Profile image must be of type: jpeg, png, jpg.',
            'profile_picture.max' => 'Profile image must be smaller than :max kilobytes.',

            'per_min_charge' => 'Per Minute Charge Amount is Required!',
            'category_id' => 'Category is required!',
            'category_id.*.integer' => 'Selection of At Least One Category is required!',
            'category_id.*.exists' => 'Selected Category does not exist!',
            'skill_id' => 'Skill is required!',
            'skill_id.*.integer' => 'Selection of At Least One Skill is required!',
            'skill_id.*.exists' => 'Selected Skill does not exist!',
            'tool_id' => 'Tool is required!',
            'tool_id.*.integer' => 'Selection of At Least One Tool is required!',
            'tool_id.*.exists' => 'Selected Tool does not exist!',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            makeResponse('error', $validator->errors()->first(), 422)
        );
    }
}
