<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegistrationRequest extends FormRequest
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
            'name' => ['required','max:50','min:3'],
            'email' => ['required','email:dns',Rule::unique('users', 'email')],
            'phone_e164' => ['required','min:10','max:15',Rule::unique('users', 'phone_e164')],
            'currency' => ['required']
        ];
    }
}
