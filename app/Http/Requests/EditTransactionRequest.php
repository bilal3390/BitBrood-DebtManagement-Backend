<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', Rule::exists('debts', 'id')],
            'user_id' => ['required', Rule::exists('users', 'id')],
            'customer_id' => ['required', Rule::exists('customers', 'id')],
            'type' => ['required'],
            'total_amount' => ['required', 'max:1000000000'], // 1 Billion
            'note' => ['nullable', 'max:50'],
            'date' => ['required','date'],
            'due_date' => ['nullable','date'],
            'source' => ['required'],
            'cheque_number' => ['nullable','max:20'],
            'source_other' => ['nullable','max:50']
        ];
    }
}
