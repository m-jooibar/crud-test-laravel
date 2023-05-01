<?php

namespace App\DTO;


use Carbon\Carbon;
use Illuminate\Support\Collection;

#[AllowDynamicProperties]
class CustomerDto
{

    private ?string $Firstname = null;
    private ?string $Lastname = null;
    private ?string $DateOfBirth = null;
    private ?string $PhoneNumber = null;
    private ?string $Email = null;
    private ?string $BankAccountNumber = null;

    public function __construct(private Collection $input)
    {
        $this->fields();
        return $this;
    }

    private function fields(): void
    {
        if ($this->input) {
            $this->input->map(function ($value, $index) {
                $this->{$index} = $value;
            });
        }
    }

    /**
     * @return string|null
     */
    public function getFirstname(): string|null
    {
        return $this->Firstname;
    }

    /**
     * @return string|null
     */
    public function getLastname(): string|null
    {
        return $this->Lastname;
    }

    /**
     * @return Carbon |null
     */
    public function getDateOfBirth(): Carbon|null
    {
        if ($this->DateOfBirth) {
            return Carbon::createFromTimeString($this->DateOfBirth);
        } else {
            return null;
        }
    }

    /**
     * @return string | null
     */
    public function getPhoneNumber(): string|null
    {
        return $this->PhoneNumber;
    }

    /**
     * @return string|null
     */
    public function getEmail(): string|null
    {
        return $this->Email;
    }

    /**
     * @return string|null
     */
    public function getBankAccountNumber(): string|null
    {
        return $this->BankAccountNumber;
    }
}
