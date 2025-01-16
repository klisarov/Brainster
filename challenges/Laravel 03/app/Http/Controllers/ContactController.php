<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'phone' => 'required',
            'company' => 'required'
        ]);

        // Basic email sending (bonus task)
        $to = 'contact@brainster.com';
        $subject = 'New Company Contact';
        $message = "Email: {$validated['email']}\n";
        $message .= "Phone: {$validated['phone']}\n";
        $message .= "Company: {$validated['company']}";
        
        mail($to, $subject, $message);

        return back()->with('success', 'Ви благодариме на интересот!');
    }
}

?>