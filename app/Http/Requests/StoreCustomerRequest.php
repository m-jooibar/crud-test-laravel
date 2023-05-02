<?php

namespace App\Http\Requests;

use App\Rules\ValidBankAccountNumber;
use App\Rules\ValidPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'PhoneNumber' => ['required', new ValidPhoneNumber],
            'Email' => ['required', 'email:rfc,dns', 'unique:customers'],
            "BankAccountNumber" => ['required', new ValidBankAccountNumber],
            "Firstname" => ["required", 'unique:customers'],
            "Lastname" => ["required", 'unique:customers'],
            "DateOfBirth" => ["required"],
        ];
    }
}
