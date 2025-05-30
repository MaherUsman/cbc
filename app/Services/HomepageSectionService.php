<?php

namespace App\Services;

use App\DataTables\HomepageSectionDataTable;
use App\Http\Requests\HomepageSectionStoreRequest;
use App\Http\Requests\HomepageSectionUpdateRequest;
use App\Models\HomepageSection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class HomepageSectionService
{
    public function index()
    {
        $homepageSection = HomepageSection::first();
        return view('admin.homepage_sections.index', compact('homepageSection'));
    }

    public function create()
    {
        if (request()->is('api/*')) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            $homepageSection = HomepageSection::first();
            return view('admin.homepage_sections.create', compact('homepageSection'));
        }
    }

    public function store(HomepageSectionStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            // Find existing section or create new instance
            $section = HomepageSection::first();

            if ($request->hasFile('background_image')) {
                $file = $request->file('background_image');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                $destinationPath = public_path('homepage');

                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                // Delete old image if updating
                if ($section && $section->background_image && file_exists(public_path($section->background_image))) {
                    unlink(public_path($section->background_image));
                }

                $file->move($destinationPath, $filename);
                $data['background_image'] = 'homepage/' . $filename;
            }

            if (!$section) {
                // Create new record
                $section = HomepageSection::create($data);
            } else {
                // Update existing record
                $section->update($data);
            }

            DB::commit();

            return makeResponse('success', 'Saved Successfully!', Response::HTTP_OK, $section);
        } catch (\Exception $exception) {
            DB::rollBack();

            $errorMessage = $exception->getMessage() ?: 'Unknown error';
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(HomepageSection $homepageSection)
    {
        try {
            if ($homepageSection->background_image) {
                $oldImagePath = str_replace('storage/', '', $homepageSection->background_image);
                if (Storage::disk('public')->exists($oldImagePath)) {
                    Storage::disk('public')->delete($oldImagePath);
                }
            }

            $homepageSection->delete();

            return makeResponse('success', 'Deleted Successfully!', Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            $errorMessage = $exception->getMessage() ?: 'Unknown error';
            return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
