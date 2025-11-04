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
        return view('frontend.index', $data);
    }

    public function aboutUs()
    {
        $data = $this->service->aboutUs();
        return view('frontend.about-us', $data);
    }

//    public function uploadImage(Request $request)
//    {
//        $validator = validator::make($request->all(), [
//            'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
//        ]);
//
//        // Store the image
//        if ($request->hasFile('upload')) {
//            $file = $request->file('upload');
//            $fileName = time() . '_' . $file->getClientOriginalName();
//            $filePath = $file->storeAs('uploads/ckeditor', $fileName, 'public');
//
//            // Return the URL for CKEditor
//            $url = Storage::url($filePath);
//
//            return response()->json([
//                'uploaded' => 1,
//                'fileName' => $fileName,
//                'url' => $url,
//            ]);
//        }
//
//        return response()->json([
//            'uploaded' => 0,
//            'error' => ['message' => 'File upload failed.'],
//        ]);
//    }

    public function uploadImage(Request $request)
    {
//        dd($request->all());
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'uploaded' => 0,
                'error' => ['message' => 'Validation failed: ' . $validator->errors()->first()]
            ]);
        }

        // Store the image
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Store in public folder
            $filePath = 'uploads/ckeditor/' . $fileName;
            $file->move(public_path('uploads/ckeditor'), $fileName);

            // Return the URL for CKEditor
            $url = asset('uploads/ckeditor/' . $fileName);

//            return response()->json([
//                'uploaded' => 1,
//                'fileName' => $fileName,
//                'url' => $url,
//            ]);
            return response()->json(['location'=> asset($filePath)]);
        }

        return response()->json([
            'uploaded' => 0,
            'error' => ['message' => 'File upload failed.'],
        ]);
    }

    public function rearchArticle()
    {
        $researchArticle = $this->service->rearchArticle();
//        return view('frontend.rearch_article', $data);
        return view('frontend.researchArticleDetail', compact('researchArticle'));
    }

    public function security()
    {
        $security = $this->service->security();
        return view('frontend.security', compact('security'));
    }

    public function contactUs()
    {
        return view('frontend.contact-us');
    }
}
