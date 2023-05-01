<?php

namespace App\Http\Controllers;

use App\Domain\Customer\CustomerAggregateRoot;
use App\Domain\Customer\Services\CustomerService;
use App\DTO\CustomerDto;
use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Carbon\Carbon;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;


class CustomerController extends Controller
{
    private CustomerService $customerService;

    #[Pure] public function __construct()
    {
        $this->customerService = new CustomerService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = $this->customerService->getCustomerList();
        return view('customers.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $this->customerService->storeNewCustomer(collect($request->all()));
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('customers.show', [
            'customer' => $customer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', [
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer): \Illuminate\Http\RedirectResponse
    {
        $this->customerService->updateOneCustomer(collection: collect($request->all()), customer: $customer);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer): \Illuminate\Http\RedirectResponse
    {
        $this->customerService->deleteOneCustomer($customer);
        return back();
    }
}
