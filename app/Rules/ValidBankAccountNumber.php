<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidBankAccountNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->checkAccountNumber($value)) {
            $fail(":attribute is invalid");
        }
    }

    private function checkAccountNumber($number)
    {
        // we check that the account number is valid or not . we assume that will be true.
        return true;
    }
}
