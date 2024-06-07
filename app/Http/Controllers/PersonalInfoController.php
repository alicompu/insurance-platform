<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonalInfoController extends Controller
{
    public function store(Request $request)
    {
        // Handle the form submission
        $data = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'contactPreference' => 'required|string|in:Email,Phone',
        ]);

        // Process the data (e.g., save to database, send an email, etc.)

        return redirect()->route('personal-info-form')->with('success', 'Personal information submitted successfully!');
    }

    public function showForm()
    {
        return Inertia::render('PersonalInformationForm');
    }
}
