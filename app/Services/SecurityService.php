<?php

namespace App\Services;

use App\Http\Requests\SecurityStoreRequest;
use App\Http\Requests\SecurityUpdateRequest;
use App\Models\Security;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class SecurityService
{
    public function getSecurityById($id)
    {
        return Security::findOrFail($id);
    }

    public function createOrEdit()
    {
        $security = Security::first();
        if ($security) {
            return view('admin.security.edit',compact('security'));
        } else {
            return view('admin.security.create');
        }
    }

    public function store(SecurityStoreRequest $request)
    {
        $security= Security::create($request->all());
        return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $security);
    }

    public function update(SecurityUpdateRequest $request, Security $article)
    {
        if ($request->has('banner_image')) {
            $this->deleteImage($article->banner_image);
        }

        $article->update($request->all());
        return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $article);
    }

    public function destroy(Security $article)
    {
        $this->deleteImage($article->banner_image);
        foreach ($article->galleries as $gallery) {
            $this->deleteImage($gallery->image);
            $gallery->delete();
        }
        $article->delete();
        return makeResponse('success', 'Deleted Successfully!', Response::HTTP_OK);
    }

    protected function deleteImage($imagePath)
    {
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
}
