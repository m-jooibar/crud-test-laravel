<?php

namespace App\Domain\Customer\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;


class CustomerUpdated extends ShouldBeStored
{
    public function __construct(
        public ?string $Firstname = null,
        public ?string $Lastname = null,
        public ?string $DateOfBirth = null,
        public ?string $PhoneNumber = null,
        public ?string $Email = null,
        public ?string $BankAccountNumber = null,
    )
    {
    }
}
