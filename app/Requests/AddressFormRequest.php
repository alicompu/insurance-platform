<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'street_address' => 'nullable|string|max:255',
            'apt' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:2',
            'zip' => 'required|string|max:10',
        ];
    }
}
