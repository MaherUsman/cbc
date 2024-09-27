<?php

namespace App\Http\Controllers;

use App\Models\GalleriesContent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GalleriesContentController extends Controller
{
    public function content_store(Request $request)
    {
        $galleriesContent = GalleriesContent::where('type', $request->type)->first();
        if (!$galleriesContent){
            $galleriesContent = new GalleriesContent();
        }
        $data = [
            'title' => $request->title,
            'details' => $request->details,
        ];
        $galleriesContent->type = $request->type;
        $galleriesContent->data = $data;
        $galleriesContent->save();
        return makeResponse('success', 'Gallery Content Updated Successfully!', Response::HTTP_OK, $galleriesContent);
    }
}
