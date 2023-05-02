<?php

namespace App\Http\Controllers\Api;

use App\Domain\Customer\Services\CustomerService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\Pure;

class CustomerController extends Controller
{
    private CustomerService $customerService;

    #[Pure] public function __construct()
    {
        $this->customerService = new CustomerService();
    }

    /**
     * Normalize response
     */
    private function normalizeResponse($error, $data): \Illuminate\Support\Collection
    {
        $response = collect([]);
        if ($error) {
            $response->put('error', true);
            $response->put('message', $data);
        } else {
            $response->put('success', true);
            $response->put('data', $data);
        }
        return $response;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $customers = $this->customerService->getCustomerList();
            return response()->json($this->normalizeResponse(false, $customers));
        } catch (\Exception $exception) {
            return response()->json($this->normalizeResponse(true, $exception->getMessage()));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        try {
            $this->customerService->storeNewCustomer(collect($request->all()));
            return response()->json($this->normalizeResponse(false, 'Customer added successfully'));
        } catch (\Exception $exception) {
            return response()->json($this->normalizeResponse(true, $exception->getMessage()));
        }
    }

    /**
     * Show created customer in storage.
     */
    public function show(Customer $customer)
    {
        try {
            return response()->json($this->normalizeResponse(false, $customer));
        } catch (\Exception $exception) {
            return response()->json($this->normalizeResponse(true, $exception->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        try {
            $this->customerService->updateOneCustomer(collection: collect($request->all()), customer: $customer);
            return response()->json($this->normalizeResponse(false, 'customer updated successfully'));
        } catch (\Exception $exception) {
            return response()->json($this->normalizeResponse(true, $exception->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        try {
            $this->customerService->deleteOneCustomer($customer);
            return response()->json($this->normalizeResponse(false, 'customer deleted successfully'));
        } catch (\Exception $exception) {
            return response()->json($this->normalizeResponse(true, $exception->getMessage()));
        }
    }
}
