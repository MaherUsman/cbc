<?php

namespace App\Http\Controllers;

use App\DataTables\StudentDataTable;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function index(StudentDataTable $dataTable)
    {
        return $this->studentService->index($dataTable);
    }

    public function create()
    {
        return $this->studentService->create();
    }

    public function store(StudentStoreRequest $request)
    {
        return $this->studentService->store($request);
    }

    public function show(Student $student)
    {
        // not used
    }

    public function edit(Student $student)
    {
        return $this->studentService->edit($student);
    }

    public function update(StudentUpdateRequest $request, Student $student)
    {
        return $this->studentService->update($request, $student);
    }

    public function destroy(Student $student)
    {
        return $this->studentService->destroy($student);
    }

    public function updateDescription(Request $request)
    {
        $setting = \App\Models\Settings::first();
        if($setting){
            $setting->student_page_title = $request->student_page_title;
            $setting->student_page_description = $request->student_page_description;
            if($request->hasFile('student_page_banner')){
                $file = $request->file('student_page_banner');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/settings/', $filename);
                $setting->student_page_banner = 'uploads/settings/' . $filename;
            }
            $setting->save();
        }
        return response()->json(['result'=>'success','message'=>'Description Updated Successfully!'], 200);
    }
}

