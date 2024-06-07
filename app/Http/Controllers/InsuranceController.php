<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    public function store(Request $request)
    {
        // Handle the form submission
        $data = $request->validate([
            'home' => 'required|boolean',
            'auto' => 'required|boolean',
            'rv' => 'required|boolean',
        ]);

        return redirect()->route('insurance-form')->with('success', 'Form submitted successfully!');
    }
}
