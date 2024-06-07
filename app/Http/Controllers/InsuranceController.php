<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class InsuranceController extends Controller
{
    public function store(Request $request)
    {
        session()->put($request->all());

        return redirect()->to("personal-info-form");
    }
}
