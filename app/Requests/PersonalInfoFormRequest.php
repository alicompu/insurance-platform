<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalInfoFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:personal_infos,email', // Add unique validation
            'phone' => 'required|string|max:15',
            'contact_preference' => 'required|string|in:email,phone',
        ];
    }
}
