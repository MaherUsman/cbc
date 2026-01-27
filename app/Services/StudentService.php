<?php

namespace App\Services;

use App\DataTables\StudentDataTable;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\Student;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class StudentService
{
    public function index(StudentDataTable $dataTable)
    {
        return $dataTable->render('admin.students.index');
    }

    public function getStudents()
    {
        $students = Student::all();
        if (request()->expectsJson()) {
            return makeResponse('success', 'List', Response::HTTP_OK, $students);
        } else {
            return view('admin.students.index', compact('students'));
        }
    }

    public function create()
    {
        if (request()->expectsJson()) {
            return makeResponse('success', '', Response::HTTP_OK);
        } else {
            return view('admin.students.create');
        }
    }

    public function store(StudentStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            // Handle uploaded picture file (if provided)
            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                $fileName = time() . '_' . preg_replace('/[^A-Za-z0-9_.-]/', '_', $file->getClientOriginalName());
                $destination = public_path('upload/students');
                if (!is_dir($destination)) {
                    mkdir($destination, 0755, true);
                }
                $file->move($destination, $fileName);
                $data['picture'] = 'upload/students/' . $fileName;
            }

            // Also support file input named 'pic' (matches chunk upload and other forms)
            if ($request->hasFile('pic')) {
                $file = $request->file('pic');
                $fileName = time() . '_' . preg_replace('/[^A-Za-z0-9_.-]/', '_', $file->getClientOriginalName());
                $destination = public_path('upload/students');
                if (!is_dir($destination)) {
                    mkdir($destination, 0755, true);
                }
                $file->move($destination, $fileName);
                $data['picture'] = 'upload/students/' . $fileName;
            }

            // Support chunk-upload path coming as 'pic' (image upload handler) where 'pic' is a path string
            if (empty($data['picture']) && isset($data['pic']) && is_string($data['pic'])) {
                $data['picture'] = $data['pic'];
                unset($data['pic']);
            }

            $student = Student::create($data);
            DB::commit();

            if (request()->expectsJson()) {
                return makeResponse('success', 'Created Successfully!', Response::HTTP_CREATED, $student);
            }

            // For web requests, redirect back to listing with a success message
            return redirect()->route('students.index')->with('success', 'Created Successfully!');
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage) && method_exists($exception, 'getResponse')) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message ?? $errorMessage;
            }
            if (request()->expectsJson()) {
                return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            return redirect()->back()->withErrors($errorMessage)->withInput();
        }
    }

    public function edit(Student $student)
    {
        if (request()->expectsJson()) {
            return makeResponse('success', 'Student Details', Response::HTTP_OK, $student);
        } else {
            return view('admin.students.edit', compact('student'));
        }
    }

    public function update(StudentUpdateRequest $request, Student $student)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            // Handle new uploaded picture and remove old if exists
            if ($request->hasFile('picture')) {
                // delete old file if exists
                if ($student->picture) {
                    $oldPath = public_path($student->picture);
                    if (file_exists($oldPath)) {
                        @unlink($oldPath);
                    }
                }
                $file = $request->file('picture');
                $fileName = time() . '_' . preg_replace('/[^A-Za-z0-9_.-]/', '_', $file->getClientOriginalName());
                $destination = public_path('upload/students');
                if (!is_dir($destination)) {
                    mkdir($destination, 0755, true);
                }
                $file->move($destination, $fileName);
                $data['picture'] = 'upload/students/' . $fileName;
            }

            // Also support file input named 'pic'
            if ($request->hasFile('pic')) {
                if ($student->picture) {
                    $oldPath = public_path($student->picture);
                    if (file_exists($oldPath)) {
                        @unlink($oldPath);
                    }
                }
                $file = $request->file('pic');
                $fileName = time() . '_' . preg_replace('/[^A-Za-z0-9_.-]/', '_', $file->getClientOriginalName());
                $destination = public_path('upload/students');
                if (!is_dir($destination)) {
                    mkdir($destination, 0755, true);
                }
                $file->move($destination, $fileName);
                $data['picture'] = 'upload/students/' . $fileName;
            }

            // Support chunk-upload path coming as 'pic'
            if (empty($data['picture']) && isset($data['pic']) && is_string($data['pic'])) {
                $data['picture'] = $data['pic'];
                unset($data['pic']);
            }

            $student->update($data);
            DB::commit();

            if (request()->expectsJson()) {
                return makeResponse('success', 'Updated Successfully!', Response::HTTP_OK, $student);
            }

            return redirect()->route('students.index')->with('success', 'Updated Successfully!');
        } catch (\Exception $exception) {
            DB::rollBack();
            $errorMessage = $exception->getMessage();
            if (empty($errorMessage) && method_exists($exception, 'getResponse')) {
                $errorMessage = json_decode($exception->getResponse()->getContent())->message ?? $errorMessage;
            }
            if (request()->expectsJson()) {
                return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            return redirect()->back()->withErrors($errorMessage)->withInput();
        }
    }

    public function destroy(Student $student)
    {
        try {
            $student->delete();
            if (request()->expectsJson()) {
                return makeResponse('success', 'Deleted Successfully!', Response::HTTP_OK);
            }
            return redirect()->route('students.index')->with('success', 'Deleted Successfully!');
        } catch (\Exception $exception) {
            $errorMessage = $exception->getMessage();
            if (request()->expectsJson()) {
                return makeResponse('error', 'error: ' . $errorMessage, Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            return redirect()->back()->withErrors($errorMessage);
        }
    }
}

