<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResearchArticleStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'title' => 'required|string|max:255',
//            'description' => 'required|string',
            'article_pdf_file' => 'required|string',
//            'banner_image' => 'required|string',
            //'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        return $rules;
    }
}
