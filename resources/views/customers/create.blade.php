@extends('customers.layout.layout')

@section('body')

    <div class="w-full justify-center flex flex-col items-center bg-gray-900 h-screen">

        <div class="w-2/4 items-center p-5 text-white bg-gray-800 rounded-md overflow-x-auto overflow-y-auto h-[32rem]">
            <form method="POST" action="{{ route('store_customer')  }}">
                @csrf
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
                    Save new customer
                </button>
                <div class="w-full flex flex-row">
                    <div class="mb-4 w-2/4 p-2">
                        <label class="block text-gray-100 text-sm font-bold mb-2" for="username">
                            Firstname
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline"
                            id="Firstname" type="text" placeholder="Firstname" name="Firstname"
                            value="{{old("Firstname")}}">
                    </div>
                    <div class="mb-4 w-2/4 p-2">
                        <label class="block text-gray-100 text-sm font-bold mb-2" for="Lastname">
                            Lastname
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline"
                            id="Lastname" type="text" placeholder="Lastname" name="Lastname"
                            value="{{old("Lastname")}}">
                    </div>
                </div>
                <div class="w-full flex flex-row">
                    <div class="mb-4 w-2/4 p-2">
                        <label class="block text-gray-100 text-sm font-bold mb-2" for="PhoneNumber">
                            PhoneNumber
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline"
                            id="PhoneNumber" type="text" placeholder="PhoneNumber" name="PhoneNumber"
                            value="{{old("PhoneNumber")}}">
                    </div>
                    <div class="mb-4 w-2/4 p-2">
                        <label class="block text-gray-100 text-sm font-bold mb-2" for="Email">
                            Email
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline"
                            id="Email" type="text" placeholder="Email" name="Email" value="{{old("Email")}}">
                    </div>
                </div>
                <div class="w-full flex flex-row">
                    <div class="mb-4 w-2/4 p-2">
                        <label class="block text-gray-100 text-sm font-bold mb-2" for="BankAccountNumber">
                            Bank account number
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline"
                            id="BankAccountNumber" type="text" placeholder="BankAccountNumber" name="BankAccountNumber"
                            value="{{old("BankAccountNumber")}}">
                    </div>
                    <div class="mb-4 w-2/4 p-2">
                        <label class="block text-gray-100 text-sm font-bold mb-2" for="DateOfBirth">
                            Date of birth
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline"
                            id="DateOfBirth" type="datetime-local" placeholder="Date of birth" name="DateOfBirth"
                            value="{{old("DateOfBirth")}}">
                    </div>
                </div>
            </form>

            @if($errors->any())
                @foreach($errors->all() as $error )
                    <li>{{ $error }}</li>
                @endforeach
            @endif
        </div>
    </div>

@endsection
