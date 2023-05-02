@extends('customers.layout.layout')

@section('body')

    <div class="w-full justify-center flex flex-col items-center bg-gray-900 h-screen">

        <div class="w-2/4 items-center p-5 text-white bg-gray-800 rounded-md overflow-x-auto overflow-y-auto h-[32rem]">
            <form method="POST" action="{{ route('destroy_customer',$customer->id)  }}">
                @csrf
                @method("DELETE")
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mb-4">
                    Delete customer
                </button>

                <a class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4"
                   href="{{route('index_customer')}}">
                    Cancel
                </a>

                <div class="mb-4 mt-4">
                    <label class="block text-gray-100 text-sm font-bold mb-2" for="username">
                        Firstname : {{$customer["Firstname"]}}
                    </label>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-100 text-sm font-bold mb-2" for="Lastname">
                        Lastname: {{$customer["Lastname"]}}
                    </label>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-100 text-sm font-bold mb-2" for="PhoneNumber">
                        Phone number : {{$customer["PhoneNumber"]}}
                    </label>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-100 text-sm font-bold mb-2" for="Email">
                        Email : {{$customer["Email"]}}
                    </label>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-100 text-sm font-bold mb-2" for="BankAccountNumber">
                        Date of birth :{{$customer["DateOfBirth"]}}
                    </label>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-100 text-sm font-bold mb-2" for="BankAccountNumber">
                        Bank account number :{{$customer["BankAccountNumber"]}}
                    </label>
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
