<?php

namespace App\Services\Frontend;

use App\Models\ContactUs;

class ContactUsService
{
    public function submitContactUsForm($request)
    {
        ContactUs::create([
           'name' => $request->name,
           'email' => $request->email,
           'subject' => $request->subject,
           'message' => $request->message,
           'phone_number' => $request->phone,
        ]);
    }
}
