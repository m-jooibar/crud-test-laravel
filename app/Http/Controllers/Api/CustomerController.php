<?php

namespace App\Http\Controllers\Api;

use App\Domain\Customer\Services\CustomerService;
use App\Http\Controllers\Controller;
use App\Models\Customer;
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
     * @OA\Get(
     *     path="/api/customers",
     *     tags={"customers"},
     *     summary="Get all customers",
     *     description="Get all customers list",
     *     operationId="index",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
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

//PhoneNumber
//Email
//BankAccountNumber
//Firstname
//Lastname
//DateOfBirth

    /**
     * @OA\Post(
     *     path="/api/customers/store",
     *     tags={"customers","store"},
     *     summary="Add new customer to database",
     *     operationId="store",
     *     @OA\Parameter(
     *         name="PhoneNumber",
     *         in="path",
     *         description="phone number",
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     * )
     */
    public function store(\App\Http\Requests\Api\StoreCustomerRequest $request)
    {
        try {
            $this->customerService->storeNewCustomer(collect($request->all()));
            return response()->json($this->normalizeResponse(false, 'Customer added successfully'));
        } catch (\Exception $exception) {
            return response()->json($this->normalizeResponse(true, $exception->getMessage()));
        }
    }


    /**
     * @OA\Get(
     *     path="/api/customers/show/{customer}",
     *     tags={"customers","show"},
     *     summary="Get single customer",
     *     description="Get single customer",
     *     operationId="show",
     *       @OA\Parameter(
     *         name="customer",
     *         in="path",
     *         description="ID of customer to return",
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     )
     * )
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
     * @OA\Post(
     *     path="/api/customers/update/{customer}",
     *     tags={"customers","update"},
     *     summary="update existing customer to database",
     *     operationId="update",
     *     @OA\Parameter(
     *         name="customer",
     *         in="path",
     *         description="customer id",
     *         required=true,
     *     ),
     *
     *     @OA\Parameter(
     *         name="Firstame",
     *         in="path",
     *         description="first name",
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     * )
     */
    public function update(\App\Http\Requests\Api\UpdateCustomerRequest $request, Customer $customer)
    {
        try {
            $this->customerService->updateOneCustomer(collection: collect($request->all()), customer: $customer);
            return response()->json($this->normalizeResponse(false, 'customer updated successfully'));
        } catch (\Exception $exception) {
            return response()->json($this->normalizeResponse(true, $exception->getMessage()));
        }
    }


    /**
     * @OA\Delete(
     *     path="/api/customers/delete/{customer}",
     *     tags={"customer","delete"},
     *     summary="Deletes a customer",
     *     operationId="destroy",
     *     @OA\Parameter(
     *         name="customer",
     *         in="path",
     *         description="customer to delete",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="customer not found",
     *     ),
     * )
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
