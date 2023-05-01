<?php

namespace App\Domain\Customer;

use App\Domain\Customer\Events\CustomerCreated;
use App\Domain\Customer\Events\CustomerDeleted;
use App\Domain\Customer\Events\CustomerUpdated;
use App\DTO\CustomerDto;
use Carbon\Carbon;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class CustomerAggregateRoot extends AggregateRoot
{

    public function createCustomer(CustomerDto $customerDto): static
    {
        $this->recordThat(new CustomerCreated(
            Firstname: $customerDto->getFirstname(),
            Lastname: $customerDto->getLastname(),
            DateOfBirth: $customerDto->getDateOfBirth(),
            PhoneNumber: $customerDto->getPhoneNumber(),
            Email: $customerDto->getEmail(),
            BankAccountNumber: $customerDto->getBankAccountNumber()
        ));
        return $this;
    }


    public function updateCustomer(CustomerDto $customerDto): static
    {
        $this->recordThat(new CustomerUpdated(
            Firstname: $customerDto->getFirstname(),
            Lastname: $customerDto->getLastname(),
            DateOfBirth: $customerDto->getDateOfBirth(),
            PhoneNumber: $customerDto->getPhoneNumber(),
            Email: $customerDto->getEmail(),
            BankAccountNumber: $customerDto->getBankAccountNumber()
        ));
        return $this;
    }


    public function deleteCustomer(): static
    {
        $this->recordThat(new CustomerDeleted());
        return $this;
    }
}
