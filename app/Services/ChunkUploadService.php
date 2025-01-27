<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
                    // Process video
//                    $compressedVideoPath = $uploadDir . $FinalPath . DIRECTORY_SEPARATOR . 'compressed-' . $FinalFileName;
//                    $thumbnailPath = $uploadDir . $FinalPath . DIRECTORY_SEPARATOR . 'thumb-' . pathinfo($FinalFileName, PATHINFO_FILENAME) . '.jpg';
//
//                    // Compress video using FFmpeg
//                    shell_exec("ffmpeg -i " . escapeshellarg($finalFile) . " -vcodec libx264 -crf 28 " . escapeshellarg($compressedVideoPath));
//
//                    // Generate video thumbnail using FFmpeg
//                    shell_exec("ffmpeg -i " . escapeshellarg($finalFile) . " -ss 00:00:01.000 -vframes 1 " . escapeshellarg($thumbnailPath));

                    return response()->json([
                        'message' => 'Video upload complete',
                        'compressedPath' => 'upload/' . $FinalPath . '/' . $FinalFileName,
//                        'compressedPath' => 'upload/' . $FinalPath . '/compressed-' . $FinalFileName,
//                        'thumbnailPath' => 'upload/' . $FinalPath . '/thumb-' . pathinfo($FinalFileName, PATHINFO_FILENAME) . '.jpg',
                    ]);
                } else {
                    // Unsupported file type
                    unlink($finalFile);
                    return response()->json(['error' => 'Unsupported file type'], 400);
                }
            }

            return response()->json(['message' => 'Chunk uploaded']);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

}
