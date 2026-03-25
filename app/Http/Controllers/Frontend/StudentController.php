<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        // show students in descending order (newest first)
        $students = Student::orderBy('id', 'desc')->get();

        return view('frontend.students.index', compact('students'));
    }
}

