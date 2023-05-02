<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use libphonenumber\PhoneNumberUtil;

class ValidPhoneNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        try {
            $numberProto = $phoneUtil->parse($value, "ir");
            if (!$phoneUtil->isValidNumber($numberProto)) {
                $fail('The :attribute should be a valid phone number.');
            }
        } catch (\Exception $exception) {
            $fail('The :attribute : ' . $exception->getMessage());
        }

    }
}
