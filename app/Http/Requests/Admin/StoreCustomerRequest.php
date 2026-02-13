<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_phone_e164' => 'required|exists:users,user_phone_e164',
            'customer_phone_e164' => 'required|unique:customers,customer_phone_e164',
            'customer_name' => 'required|string|max:255',
        ];
    }
}
