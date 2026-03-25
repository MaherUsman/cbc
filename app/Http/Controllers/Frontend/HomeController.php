<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Frontend\HomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;


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
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($validator->fails()) {
            $firstError = (string) $validator->errors()->first();
            $friendlyMessage = 'Invalid image upload. Please check the file and try again.';
            $lowerError = strtolower($firstError);

            // Make common Laravel validation messages easier to read in the UI.
            if (str_contains($lowerError, 'file of type') || str_contains($lowerError, 'mimes')) {
                $friendlyMessage = 'Invalid image type. Allowed: jpeg, png, jpg, gif, webp.';
            } elseif (
                str_contains($lowerError, 'too large') ||
                str_contains($lowerError, 'greater than') ||
                str_contains($lowerError, 'not be greater') ||
                str_contains($lowerError, 'size') ||
                str_contains($lowerError, 'mb') ||
                str_contains($lowerError, 'kb')
            ) {
                // Try to extract the max size from Laravel's message.
                $maxMb = null;
                if (preg_match('/(\d+(?:\.\d+)?)\s*mb/i', $firstError, $m)) {
                    $maxMb = (float) $m[1];
                } elseif (preg_match('/(\d+(?:\.\d+)?)\s*kb/i', $firstError, $m)) {
                    $maxMb = ((float) $m[1]) / 1024;
                }

                if ($maxMb !== null) {
                    // Display without trailing zeros (e.g. "2MB" instead of "2.00MB").
                    $maxMbFormatted = rtrim(rtrim(number_format($maxMb, 2, '.', ''), '0'), '.');
                    $friendlyMessage = 'Image is too large. Maximum size is ' . $maxMbFormatted . 'MB.';
                } else {
                    $friendlyMessage = 'Image is too large. Maximum size is 2MB.';
                }
            } elseif (str_contains($lowerError, 'image')) {
                $friendlyMessage = 'The selected file is not a valid image.';
            }

            return response()->json([
                'uploaded' => 0,
                'error' => ['message' => $friendlyMessage],
            ], 422);
        }

        if (! $request->hasFile('file')) {
            return response()->json([
                'uploaded' => 0,
                'error' => ['message' => 'No image file received. Please choose an image and try again.'],
            ], 400);
        }

        try {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $uploadDirectory = public_path('uploads/ckeditor');

            if (! is_dir($uploadDirectory)) {
                mkdir($uploadDirectory, 0755, true);
            }

            $filePath = 'uploads/ckeditor/' . $fileName;
            $file->move($uploadDirectory, $fileName);

            return response()->json(['location' => asset($filePath)], 200);
        } catch (Throwable $exception) {
            $detail = (app()->environment(['local', 'testing']) ? $exception->getMessage() : null);
            return response()->json([
                'uploaded' => 0,
                'error' => [
                    'message' => 'Upload failed on the server. Please try again.',
                    'detail' => $detail,
                ],
            ], 500);
        }
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
