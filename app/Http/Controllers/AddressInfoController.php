<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AddressInfoController extends Controller
{
    public function store(Request $request)
    {
        // Handle the form submission
        $data = $request->validate([
            'streetAddress' => 'nullable|string|max:255',
            'apt' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:2',
            'zip' => 'required|string|max:10',
        ]);

        // Process the data (e.g., save to database, send an email, etc.)

        return redirect()->route('address-info-form')->with('success', 'Address information submitted successfully!');
    }

    public function showForm()
    {
        return Inertia::render('AddressInformationForm');
    }
}
