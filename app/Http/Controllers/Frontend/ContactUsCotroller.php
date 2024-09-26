<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Frontend\ContactUsService;
use Illuminate\Http\Request;

class ContactUsCotroller extends Controller
{
    protected $contactService;

    public function __construct(ContactUsService $contactService)
    {
        $this->contactService = $contactService;
    }


    public function contactUs()
    {
        return view('frontend.contact-us');
    }
    public function submit(Request $request)
    {
        // Validate the form data
        $request->validate([
            'username' => 'required|string|min:3|max:255',
            'email'    => 'required|email|max:255|unique:contact_us,email',
            'phone'    => 'required|min:10|max:15|unique:contact_us,phone_number',
            'subject'  => 'required|string|min:3|max:255',
            'message'  => 'required|string|min:10',
        ]);

        try {
            $this->contactService->submitContactUsForm($request);

            return redirect()->back()->with('success', 'Your message has been sent successfully!');
        } catch (\Exception $e) {
            // Error handling
            return redirect()->back()->withErrors(['error' => 'Failed to send your message. Please try again later.']);
        }
    }
}
