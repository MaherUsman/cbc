<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Frontend\HomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    protected $service;

    public function __construct(HomeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->index();
        return view('frontend.index' , $data);
    }

    public function aboutUs()
    {
        $data = $this->service->aboutUs();
        return view('frontend.about-us' , $data);
    }


        public function uploadImage(Request $request)
    {
        $validator = validator::make($request->all(), [
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the image
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/ckeditor', $fileName, 'public');

            // Return the URL for CKEditor
            $url = Storage::url($filePath);

            return response()->json([
                'uploaded' => 1,
                'fileName' => $fileName,
                'url' => $url,
            ]);
        }

        return response()->json([
            'uploaded' => 0,
            'error' => ['message' => 'File upload failed.'],
        ]);
    }

    public function rearchArticle()
    {
        $data = $this->service->rearchArticle();
        return view('frontend.rearch_article' , $data);
    }

    public function contactUs()
    {
        return view('frontend.contact-us');
    }
}
