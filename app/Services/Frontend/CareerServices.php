<?php

namespace App\Services\Frontend;

use App\Models\CareerApplication;
use Illuminate\Support\Facades\Mail;

class CareerServices
{
    public function processApplication($validatedData, $uploadedFile)
    {
        // Store the uploaded file (resume) and get the file path
        $filePath = $uploadedFile->store('resumes', 'public');

        // Save form data into the database
        CareerApplication::create([
            'username' => $validatedData['username'],
            'job_id' => isset($validatedData['job_id'])?$validatedData['job_id']:null,
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'subject' => $validatedData['subject'],
            'resume_path' => $filePath, // Store the file path
        ]);
    }
}
