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

            // Always get the first (and only) record
            $section = HomepageSection::first();

            // Handle file upload
            if ($request->hasFile('background_image')) {
                $file = $request->file('background_image');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('homepage');

                // Create directory if it doesn't exist
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                // Delete old image if updating and old image exists
                if ($section && $section->background_image) {
                    $oldImagePath = public_path($section->background_image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Move new file
                $file->move($destinationPath, $filename);
                $data['background_image'] = 'homepage/' . $filename;
            }

            if ($section) {
                // Update existing record
                $section->update($data);
                $message = 'Homepage section updated successfully!';
            } else {
                // Create new record (first time)
                $section = HomepageSection::create($data);
                $message = 'Homepage section created successfully!';
            }

            DB::commit();

            return makeResponse('success', $message, Response::HTTP_OK, $section);

        } catch (\Exception $exception) {
            DB::rollBack();

            return makeResponse('error', 'Error: ' . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy()
    {
        try {
            $section = HomepageSection::first();

            if ($section) {
                // Delete associated image file
                if ($section->background_image) {
                    $imagePath = public_path($section->background_image);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }

                $section->delete();

                return makeResponse('success', 'Homepage section deleted successfully!', Response::HTTP_OK);
            }

            return makeResponse('error', 'No homepage section found to delete.', Response::HTTP_NOT_FOUND);

        } catch (\Exception $exception) {
            return makeResponse('error', 'Error: ' . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
