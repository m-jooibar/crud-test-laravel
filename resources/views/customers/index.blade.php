@extends('customers.layout.layout')

@section('body')

    <div class="w-full justify-center flex flex-col items-center bg-gray-900 h-screen">
        <div class="w-2/4  mb-4 flex justify-between ">
            <a class="p-2 bg-blue-500 rounded-md text-white" href="{{ route('create_customer')  }}">
                New customer
            </a>

            @if(session()->has('customer_added'))
                <span
                    class="bg-green-500 p-2  flex justify-center items-center">{{session()->get('customer_added')}}</span>
            @endif
            @if(session()->has('customer_removed'))
                <span
                    class="bg-red-500 p-2 flex text-white justify-center items-center">{{session()->get('customer_removed')}}</span>
            @endif
        </div>
        <div class="w-2/4 items-center p-5 text-white bg-gray-800 rounded-md overflow-x-auto overflow-y-auto h-[32rem]">
            @if(sizeof($customers))
                @foreach($customers as $customer)
                    <div class="w-full flex flex-row  text-gray-900 bg-gray-600 p-5 mt-4 mb-4 rounded-md">
                        <div class="w-3/4">
                            <div class="text-white mt-2">
                                Firstname : {{  $customer['Firstname'] }}
                            </div>
                            <div class="text-white mt-2">
                                Lastname : {{  $customer['Lastname'] }}
                            </div>
                            <div class="text-white mt-2">
                                PhoneNumber: {{  $customer['PhoneNumber'] }}
                            </div>
                            <div class="text-white mt-2">
                                Email : {{  $customer['Email'] }}
                            </div>
                            <div class="text-white mt-2">
                                BankAccountNumber : {{  $customer['BankAccountNumber'] }}
                            </div>
                        </div>
                        <div class="w-1/4 flex items-center gap-4 justify-center">
                            <a class="p-2 bg-green-500 rounded-md text-white"
                               href="{{route('edit_customer',$customer->id)}}">
                                Edit
                            </a>
                            <a class="p-2 bg-red-500 rounded-md text-white"
                               href="{{route('delete_customer',$customer->id)}}">
                                Delete
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="w-full flex flex-row  text-gray-900 bg-gray-600 p-5 mt-4 mb-4 rounded-md">
                    {{ __('Not found any customer') }}
                </div>
            @endif

        </div>
    </div>
@endsection
