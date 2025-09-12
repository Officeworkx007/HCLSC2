@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('page-title', 'Panel Lawyers Creation')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-xl">
        <form action="{{ route('admin.panel_lawyers.store') }}" method="POST">
            @csrf

            <!-- Header -->
            <div class="flex items-center justify-between mb-6 border-b pb-3">
                <h2 class="text-xl font-semibold text-gray-800">Add Panel Lawyer</h2>
                <span class="text-sm text-gray-500">Please fill in the required details</span>
            </div>

            <!-- User Info -->
            <h3 class="text-sm font-semibold text-gray-600 mb-4 uppercase tracking-wide">User Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text" id="first_name" name="first_name"
                        class="w-full border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" />
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" id="last_name" name="last_name"
                        class="w-full border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" />
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" id="email" name="email"
                        class="w-full border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" />
                </div>
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number"
                        class="w-full border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" />
                </div>
            </div>

            <!-- Contact Info -->
            <h3 class="text-sm font-semibold text-gray-600 mb-4 uppercase tracking-wide">Contact Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <input type="text" id="address" name="address"
                        class="w-full border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" />
                </div>
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                    <input type="text" id="city" name="city"
                        class="w-full border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" />
                </div>
                <div>
                    <label for="pin_code" class="block text-sm font-medium text-gray-700 mb-1">Pin Code</label>
                    <input type="text" id="pin_code" name="pin_code"
                        class="w-full border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" />
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex justify-end">
                <button
                    class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-md transition">
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection
