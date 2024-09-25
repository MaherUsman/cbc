<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
        return view('frontend.career');
    }
    public function submitApplication(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'upload' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Process the application through the service
        $this->careerService->processApplication($validated, $request->file('upload'));

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Application submitted successfully!');
    }
}
