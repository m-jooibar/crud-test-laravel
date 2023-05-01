<?php

namespace App\Domain\Customer\Services;

use App\Domain\Customer\CustomerAggregateRoot;
use App\DTO\CustomerDto;
use App\Models\Customer;
use App\Repository\CustomerRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;

class CustomerService
{
    private CustomerRepository $customerRepository;

    #[Pure] public function __construct()
    {
        $this->customerRepository = new CustomerRepository();
    }

    private function getDtoObject(Collection $collection): CustomerDto
    {
        return new CustomerDto($collection);
    }

    public function getCustomerList()
    {
        return $this->customerRepository->customerList();
    }

    public function storeNewCustomer(Collection $collection)
    {
        $newUuid = Str::uuid()->toString();
        $customerDto = $this->getDtoObject($collection);
        CustomerAggregateRoot::retrieve($newUuid)
            ->createCustomer($customerDto)
            ->persist();
    }

    public function updateOneCustomer(Collection $collection, Customer $customer)
    {
        $customerDto = $this->getDtoObject($collection);
        CustomerAggregateRoot::retrieve($customer->uuid)
            ->updateCustomer($customerDto)
            ->persist();
    }

    public function deleteOneCustomer(Customer $customer)
    {
        CustomerAggregateRoot::retrieve($customer->uuid)
            ->deleteCustomer()
            ->persist();
    }
}
