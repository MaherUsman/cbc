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
}

