<?php

namespace App\Services\Frontend;

use App\Models\ContactUs;

class ContactUsService
{
    public function submitContactUsForm($request)
    {
        ContactUs::create([
           'full_name' => $request->username,
           'email' => $request->email,
           'subject' => $request->subject,
           'details' => $request->message,
           'phone_number' => $request->phone,
        ]);
    }
}
