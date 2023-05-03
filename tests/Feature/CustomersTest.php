<?php

namespace Tests\Feature;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CustomersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * make a request.
     */
    public function test_make_a_success_request(): void
    {
        $response = $this->get(route('api_index_customer'));
        $response->assertStatus(200);
    }

    public function test_create_new_customer(): void
    {

        $customerDate = [
            'PhoneNumber' => '09371428591',
            'Email' => 'sample@gmail.com',
            "BankAccountNumber" => '123456789',
            "Firstname" => 'Masood',
            "Lastname" => 'Jooibar',
            "DateOfBirth" => '2022-12-02 14:56:00',
        ];

        $response = $this->postJson(route('api_store_customer'), $customerDate);
        $response->assertJson(fn(AssertableJson $json) => $json->hasAny(['success', 'data'])->where('success', true)->where('data', 'Customer added successfully')
        );
    }

    public function test_recreate_exist_customer(): void
    {
        $customerDate = [
            'PhoneNumber' => '09371428591',
            'Email' => 'sample@gmail.com',
            "BankAccountNumber" => '123456789',
            "Firstname" => 'Masood',
            "Lastname" => 'Jooibar',
            "DateOfBirth" => '2022-12-02 14:56:00',
        ];

        $response = $this->postJson(route('api_store_customer'), $customerDate);
        $response->assertJson(fn(AssertableJson $json) => $json->hasAny(['success', 'data'])->where('success', true)->where('data', 'Customer added successfully')
        );

        $response = $this->postJson(route('api_store_customer'), $customerDate);
        $response->assertJson(fn(AssertableJson $json) => $json->hasAny(['error', 'message', 'data'])->where('error', true)
        )
            ->assertJsonPath('data.Email.0', 'The email has already been taken.')
            ->assertJsonPath('data.Firstname.0', 'The firstname has already been taken.')
            ->assertJsonPath('data.Lastname.0', 'The lastname has already been taken.');
    }

    public function test_fail_with_invalid_data_to_create_request()
    {
        $customerDate = [
            'PhoneNumber' => '123456qwe34',
            'Email' => '33424@a.a',
            "BankAccountNumber" => '222222222222222222222123456789',
            "Firstname" => 'Masood',
            "Lastname" => 'Jooibar',
            "DateOfBirth" => 123456,
        ];

        $response = $this->postJson(route('api_store_customer'), $customerDate);
        $response->assertJson(fn(AssertableJson $json) => $json->hasAny(['error', 'message', 'data'])->where('error', true)->where('message', 'Validation errors')
        )
            ->assertJsonPath('data.PhoneNumber.0', 'The phone number should be a valid phone number.')
            ->assertJsonPath('data.Email.0', 'The email field must be a valid email address.')
            ->assertJsonPath('data.DateOfBirth.0', 'The date of birth field must be a valid date.');
    }

    public function test_create_and_edit_one_customer()
    {


        $customerDate = [
            'PhoneNumber' => '09371428591',
            'Email' => 'sample@gmail.com',
            "BankAccountNumber" => '123456789',
            "Firstname" => 'Masood',
            "Lastname" => 'Jooibar',
            "DateOfBirth" => '2022-12-02 14:56:00',
        ];

        $response = $this->postJson(route('api_store_customer'), $customerDate);
        $response->assertJson(fn(AssertableJson $json) => $json->hasAny(['success', 'data'])->where('success', true)->where('data', 'Customer added successfully')
        );


        $customerDate = [
            'PhoneNumber' => '09213679259',
            'Email' => 'masood@gmail.com',
            "BankAccountNumber" => '123456789',
            "Firstname" => 'Masood/siavash',
            "Lastname" => 'Jooibar/jahan',
            "DateOfBirth" => '2022-12-02 14:56:00',
        ];

        $customer = Customer::latest()->first();

        $response = $this->patchJson(route('api_update_customer', $customer->id), $customerDate);
        $response->assertJson(fn(AssertableJson $json) => $json->hasAny(['success', 'data'])->where('success', true)->where('data', "Customer updated successfully"));


        $customerDate = [
            'PhoneNumber' => '09213679259',
            'Email' => 'siavash@gmail.com',
            "BankAccountNumber" => '987654321',
            "Firstname" => 'siavash',
            "Lastname" => 'jahan',
            "DateOfBirth" => '2022-12-02 14:56:00',
        ];


        $response = $this->patchJson(route('api_update_customer', $customer->id), $customerDate);
        $response->assertJson(fn(AssertableJson $json) => $json->hasAny(['success', 'data'])->where('success', true)->where('data', "Customer updated successfully"));

        $events = DB::table('stored_events')->get();
        $this->assertEquals(3, $events->count());
    }

    public function test_create_and_remove_customer()
    {

        $customerDate = [
            'PhoneNumber' => '09371428591',
            'Email' => 'sample@gmail.com',
            "BankAccountNumber" => '123456789',
            "Firstname" => 'Masood',
            "Lastname" => 'Jooibar',
            "DateOfBirth" => '2022-12-02 14:56:00',
        ];

        $response = $this->postJson(route('api_store_customer'), $customerDate);
        $response->assertJson(fn(AssertableJson $json) => $json->hasAny(['success', 'data'])->where('success', true)->where('data', 'Customer added successfully'));

        $customer = Customer::latest()->first();

        $response = $this->deleteJson(route('api_destroy_customer', $customer->id));
        $response->assertJson(fn(AssertableJson $json) => $json->hasAny(['success', 'data'])->where('success', true)->where('data', "Customer deleted successfully"));

        $customer = Customer::all()->count();
        $this->assertEquals(0, $customer);
    }


}
