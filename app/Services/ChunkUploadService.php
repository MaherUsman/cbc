<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Laravel\Facades\Image;


class ChunkUploadService
{
    public function uploadImageChunk(Request $request)
    {
        try {
            $chunk = $request->file('chunk');
            $chunkNumber = $request->input('chunkNumber');
            $totalChunks = $request->input('totalChunks');
            $fileName = preg_replace('/\s+/', '_', preg_replace('/[^A-Za-z0-9. ]/', '', trim($request->input('fileName'))));
            $FinalPath = $request->input('ImageUploadPath');
            $uploadDir = public_path('upload') . DIRECTORY_SEPARATOR;
            $chunkUploadDir = $uploadDir . 'chunks' . DIRECTORY_SEPARATOR;

            if (!File::exists($chunkUploadDir)) {
                File::makeDirectory($chunkUploadDir, 0755, true);
            }

            // Move chunk to temporary chunk directory
            $chunk->move($chunkUploadDir, $fileName . '.part' . $chunkNumber);

            // If all chunks are uploaded, process the final file
            if ($chunkNumber == $totalChunks) {
                $FinalFileName = time() . '-' . $fileName;
                $finalFile = $uploadDir . $FinalPath . DIRECTORY_SEPARATOR . $FinalFileName;

                if (!File::exists($uploadDir . $FinalPath)) {
                    File::makeDirectory($uploadDir . $FinalPath, 0755, true);
                }

                // Combine the chunks into the final file
                $out = fopen($finalFile, 'w');
                for ($i = 1; $i <= $totalChunks; $i++) {
                    $in = fopen($chunkUploadDir . $fileName . '.part' . $i, 'r');
                    while ($buffer = fread($in, 4096)) {
                        fwrite($out, $buffer);
                    }
                    fclose($in);
                    unlink($chunkUploadDir . $fileName . '.part' . $i);
                }
                fclose($out);

                // Determine file type
                $mimeType = mime_content_type($finalFile);


//                dd('video is here','upload directory:', $uploadDir, $finalFile ,$FinalFileName);

                if (str_starts_with($mimeType, 'image/')) {
                    // Process image
                    $image = Image::read($finalFile);

                    // Save compressed main image
                    $compressedImagePath = $uploadDir . $FinalPath . DIRECTORY_SEPARATOR . 'compressed-' . $FinalFileName;
                    $image->save($compressedImagePath, 75);

                    // Create and save thumbnail
                    $thumbnailPath = $uploadDir . $FinalPath . DIRECTORY_SEPARATOR . 'thumb-' . $FinalFileName;
                    $image->resize(452, 422, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($thumbnailPath);

                    return response()->json([
                        'message' => 'Image upload complete',
                        'filePath' => 'upload/' . $FinalPath . '/' . $FinalFileName,
                        'compressedPath' => 'upload/' . $FinalPath . '/compressed-' . $FinalFileName,
                        'thumbnailPath' => 'upload/' . $FinalPath . '/thumb-' . $FinalFileName,
                    ]);
                } elseif (str_starts_with($mimeType, 'video/')) {
//                    dd('upload/' . $FinalPath . '/' . $FinalFileName);
                    return response()->json([
//                        'message' => 'Video upload complete',
  //                      'filePath' => 'upload/' . $FinalPath . '/' . $FinalFileName

 'message' => 'Video upload complete',
                        'filePath' => 'upload/' . $FinalPath . '/' . $FinalFileName,
                        'compressedPath' => 'upload/' . $FinalPath . '/compressed-' . $FinalFileName,
                        'thumbnailPath' => 'upload/' . $FinalPath . '/thumb-' . $FinalFileName,

                 ]);
                } else {
                    // Unsupported file type
                    unlink($finalFile);
                    return response()->json(['error' => 'Unsupported file type'], 400);
                }
            }


//                    return response()->json([
  //                      'message' => 'Image upload complete',
    ///                    'filePath' => 'upload/' . $FinalPath . '/' . $FinalFileName,
       //                 'compressedPath' => 'upload/' . $FinalPath . '/compressed-' . $FinalFileName,
         //               'thumbnailPath' => 'upload/' . $FinalPath . '/thumb-' . $FinalFileName,
           //         ]);

            return response()->json(['message' => 'Chunk uploaded']);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function uploadFileChunk(Request $request)
    {
        try {
            // Validate required parameters
            $validator = Validator::make($request->all(), [
                'chunk' => 'required|file',
                'chunkNumber' => 'required|integer|min:1',
                'totalChunks' => 'required|integer|min:1',
                'fileName' => 'required|string',
                'uploadPath' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()], 400);
            }

            $chunk = $request->file('chunk');
            $chunkNumber = (int)$request->input('chunkNumber');
            $totalChunks = (int)$request->input('totalChunks');
            $originalName = $request->input('fileName');

            // Sanitize filename
            $fileName = preg_replace('/[^\w\.-]/', '_', $originalName);
            $uploadPath = trim($request->input('uploadPath'), '/');

            // Set up directories
            $baseDir = public_path('uploads') . DIRECTORY_SEPARATOR;
            $chunkDir = $baseDir . 'chunks' . DIRECTORY_SEPARATOR;
            $finalDir = $baseDir . $uploadPath . DIRECTORY_SEPARATOR;

            // Create directories if needed
            if (!File::exists($chunkDir)) {
                File::makeDirectory($chunkDir, 0755, true);
            }

            if (!File::exists($finalDir)) {
                File::makeDirectory($finalDir, 0755, true);
            }

            // Save chunk with unique name
            $chunkTempName = md5($fileName) . '.part' . $chunkNumber;
            $chunk->move($chunkDir, $chunkTempName);

            // If this is the last chunk, combine all chunks
            if ($chunkNumber === $totalChunks) {
                // Generate final filename with timestamp to prevent collisions
                $finalFileName = time() . '_' . $fileName;
                $finalFilePath = $finalDir . $finalFileName;

                // Open final file
                $out = fopen($finalFilePath, 'wb');
                if (!$out) {
                    throw new \Exception('Could not create final file');
                }

                // Combine all chunks
                for ($i = 1; $i <= $totalChunks; $i++) {
                    $chunkPath = $chunkDir . md5($fileName) . '.part' . $i;

                    if (!file_exists($chunkPath)) {
                        fclose($out);
                        unlink($finalFilePath);
                        return response()->json(['error' => "Missing chunk $i"], 400);
                    }

                    $in = fopen($chunkPath, 'rb');
                    while ($buffer = fread($in, 4096)) {
                        fwrite($out, $buffer);
                    }
                    fclose($in);
                    unlink($chunkPath); // Delete the chunk
                }
                fclose($out);

                return response()->json([
                    'success' => true,
                    'message' => 'File upload complete',
                    'filePath' => 'uploads/' . $uploadPath . '/' . $finalFileName,
                    'originalName' => $originalName,
                    'fileSize' => filesize($finalFilePath),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Chunk uploaded successfully',
                'chunkNumber' => $chunkNumber,
                'totalChunks' => $totalChunks
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'error' => $exception->getMessage()
            ], 500);
        }
    }

}
