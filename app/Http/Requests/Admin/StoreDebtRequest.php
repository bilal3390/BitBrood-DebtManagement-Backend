<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreDebtRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_phone_e164' => 'required|exists:users,user_phone_e164',
            'customer_phone_e164' => 'required|exists:customers,customer_phone_e164',
            'type' => 'required|in:borrowed,gave',
            'total_amount' => 'required|numeric|min:0',
            'note' => 'nullable|string',
            'date' => 'required|date',
            'due_date' => 'nullable|date',
            'source' => 'nullable|in:Cash,Cheque,Other',
            'cheque_number' => 'nullable|string',
            'source_other' => 'nullable|string',
        ];
    }
}
