<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ChunkUploadService
{
    public function uploadImageChunk(Request $request)
    {
        try {
            $chunk = $request->file('chunk');
            $chunkNumber = $request->input('chunkNumber');
            $totalChunks = $request->input('totalChunks');
            $fileName = $request->input('fileName');
//            $fileName = str_replace(' ','_',$fileName);
            $fileName = preg_replace('/\s+/', '_', preg_replace('/[^A-Za-z0-9. ]/', '', trim($fileName)));
            $FinalPath = $request->input('ImageUploadPath');
            $uploadDir = public_path('upload').DIRECTORY_SEPARATOR;
            $chunkUploadDir = $uploadDir.'chunks'.DIRECTORY_SEPARATOR;
            if (!File::exists($chunkUploadDir)) {
                File::makeDirectory($chunkUploadDir, 0755, true);
            }
            $chunk->move($chunkUploadDir, $fileName . '.part' . $chunkNumber);
            if ($chunkNumber == $totalChunks) {
                $FinalImageName = time() . '-' . $fileName;
                $finalFile = $uploadDir . $FinalPath . DIRECTORY_SEPARATOR . $FinalImageName;
                if (!File::exists($uploadDir . $FinalPath)) {
                    File::makeDirectory($uploadDir . $FinalPath, 0755, true);
                }
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
        }catch (\Exception $exception){
            return makeResponse('error',$exception->getMessage());
        }
    }
}
