<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ChunkUploadService
{
    public function uploadImageChunk(Request $request)
    {
        $chunk = $request->file('chunk');
        $chunkNumber = $request->input('chunkNumber');
        $totalChunks = $request->input('totalChunks');
        $fileName = $request->input('fileName');
        $FinalPath = $request->input('ImageUploadPath');
        $uploadDir = public_path('upload/');
        $chunkUploadDir = $uploadDir.'chunks/';
        if (!File::exists($chunkUploadDir)) {
            File::makeDirectory($chunkUploadDir, 0755, true);
        }
        $chunk->move($chunkUploadDir, $fileName . '.part' . $chunkNumber);
        if ($chunkNumber == $totalChunks) {
            $FinalImageName = time() . '-' . $fileName;
            $finalFile = $uploadDir . $FinalPath . '/' . $FinalImageName;
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
            return response()->json(['message' => 'Upload complete', 'filePath' => 'upload/' . $FinalPath . '/' . $FinalImageName]);
        }
        return response()->json(['message' => 'Chunk uploaded']);
    }
}
