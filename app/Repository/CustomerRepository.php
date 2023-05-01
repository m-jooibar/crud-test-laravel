<?php

namespace App\Repository;

use App\Domain\Customer\Events\CustomerCreated;
use App\Domain\Customer\Events\CustomerUpdated;
use App\DTO\CustomerDto;
use App\Models\Customer;

class CustomerRepository
{
    public function customerList()
    {
        return Customer::paginate(15);
    }

    public function createNewCustomer($uuid, CustomerCreated $event)
    {
        Customer::create([
            'uuid' => $uuid,
            'Firstname' => $event->Firstname,
            'Lastname' => $event->Lastname,
            'DateOfBirth' => $event->DateOfBirth,
            'PhoneNumber' => $event->PhoneNumber,
            'Email' => $event->Email,
            'BankAccountNumber' => $event->BankAccountNumber,
        ]);
    }

    public function updateCustomer($uuid, CustomerUpdated $event)
    {
        $customer = Customer::uuid($uuid);
        $data = collect([
            'Firstname' => $event->Firstname,
            'Lastname' => $event->Lastname,
            'DateOfBirth' => $event->DateOfBirth,
            'PhoneNumber' => $event->PhoneNumber,
            'Email' => $event->Email,
            'BankAccountNumber' => $event->BankAccountNumber,
        ]);
        $customer->updateColumns($data);
    }

    public function deleteCustomer($uuid)
    {
        Customer::uuid($uuid)->delete();
    }
}
