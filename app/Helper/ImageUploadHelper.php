<?php


namespace App\Helper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;

class ImageUploadHelper
{
    public static function saveImage($image, $fileNameUpload, $path, $drive)
    {
//        dd($fileNameUpload);
        $image = ImageManager::gd()->read($image);
        $image->save($path . $fileNameUpload);
        return $drive . $fileNameUpload;
    }

    public static function uploadImage($uploadImage, $path)
    {
        $image = $uploadImage;
        $ext = $image->getClientOriginalExtension();
        $randomString = mt_rand(1000, 9999);
        $fileName = $image->getClientOriginalName();
        $fileNameUpload = time() . "-" . $randomString . '.' . $ext;
        $drive = $path;
        $path = public_path($drive);
        if (!file_exists($path)) {
            File::makeDirectory($path, 0777, true);
        }
        return ImageUploadHelper::saveImage($image, $fileNameUpload, $path, $drive);
    }

    public static function uploadFile($uploadFile, $path)
    {
        $audioFile = $uploadFile;
        $fileName = time() . '_' . $audioFile->getClientOriginalName();
        $fileName = preg_replace('/[^A-Za-z0-9.\s]/', '', trim($fileName));
//        $fileName = preg_replace('/\s+/', ' ', trim($fileName));
        $fileName = str_replace(' ', '_', $fileName);
        $drive = $path;
        $path = public_path($drive);
        if (!file_exists($path)) {
            File::makeDirectory($path, 0777, true);
        }
        $audioFile->move($path, $fileName);
        return $drive . $fileName;
    }

    public static function checkUploadImage(Request $request, $key = 'image', $path = 'general/', $obj = null)
    {
        if ($request->has($key) && $request->$key != '') {
            if ($obj){
                if ($obj->$key!=null && $obj->$key!=''){
                    unlink(public_path($obj->$key));
                }
            }
            return ImageUploadHelper::uploadImage($request->$key, 'upload/' . $path);
        }
        return null;
    }

    public static function uploadSocketImage($data)
    {
        $img = $data['attachment'];
        $img = substr($img, strpos($img, ",") + 1);
        $image = base64_decode($img);  // your base64 encoded
        $png_url = "chat-" . time() . ".png";
        $path = public_path() . '/chat/attachment/' . $png_url;
        $db_path = 'chat/attachment/' . $png_url;
        file_put_contents($path, $image);
        return $db_path;
    }
}
