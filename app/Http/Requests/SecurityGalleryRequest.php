<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SecurityGalleryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
//            'research_article_id' => 'required|exists:research_articles,id',
//            'image' => 'required|string',
            //'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
