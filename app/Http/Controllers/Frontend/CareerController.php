<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Services\Frontend\CareerServices;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    protected $careerService;

    public function __construct(CareerServices $careerService)
    {
        $this->careerService = $careerService;
    }

    public function careerPage()
    {
        $jobs = Job::all();
        return view('frontend.career',compact('jobs'));
    }

    public function specificCareer(Job $job)
    {
        return view('frontend.specific-career',compact('job'));
    }

    public function submitApplication(Request $request)
    {

        // Validate the form data
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:career_applications,email',
            'phone' => 'required|string|max:20|unique:career_applications,phone',
            'subject' => 'required|string|max:255',
            'upload' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'job_id' => 'sometimes|exists:career_jobs,id',
        ]);

        try {
            // Process the application through the service
            $this->careerService->processApplication($validated, $request->file('upload'));

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Application submitted successfully!');

        } catch (\Exception $e) {
            // Catch any exception that happens during processing (e.g., service-related errors)

            // Log the error for debugging (optional)
            \Log::error('Application Submission Error: ' . $e->getMessage());

            // Redirect back with the error message
            return redirect()->back()->withErrors(['error' => 'An error occurred while submitting your application. Please try again later.'.$e->getMessage()])->withInput();
        }
    }

}
