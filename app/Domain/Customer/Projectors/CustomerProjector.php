<?php

namespace App\Domain\Customer\Projectors;

use App\Domain\Customer\Events\CustomerCreated;
use App\Domain\Customer\Events\CustomerDeleted;
use App\Domain\Customer\Events\CustomerUpdated;
use App\Models\Customer;
use App\Repository\CustomerRepository;
use JetBrains\PhpStorm\Pure;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class CustomerProjector extends Projector
{

    private CustomerRepository $customerRepository;

    #[Pure] public function __construct()
    {
        $this->customerRepository = new CustomerRepository();
    }

    public function onCustomerCreated(CustomerCreated $event)
    {
        $this->customerRepository->createNewCustomer($event->aggregateRootUuid(), $event);
    }

    public function onCustomerUpdated(CustomerUpdated $event)
    {
        $this->customerRepository->updateCustomer($event->aggregateRootUuid(), $event);
    }

    public function onCustomerDeleted(CustomerDeleted $event)
    {
        $this->customerRepository->deleteCustomer($event->aggregateRootUuid());
    }
}
