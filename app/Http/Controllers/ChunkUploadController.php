<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChunkImageRequest;
use App\Services\ChunkUploadService;

class ChunkUploadController extends Controller
{
    public $chunkUploadService;

    public function __construct(ChunkUploadService $chunkUploadService)
    {
        $this->chunkUploadService= $chunkUploadService;
    }

    public function uploadImageChunk(ChunkImageRequest $request)
    {
        return $this->chunkUploadService->uploadImageChunk($request);
    }

    public function uploadFileChunk(ChunkImageRequest $request)
    {
//        dd($request->all());
        return $this->chunkUploadService->uploadFileChunk($request);
    }
}
