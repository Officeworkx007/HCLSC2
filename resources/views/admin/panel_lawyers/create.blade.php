@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('page-title', 'Panel Lawyers Creation')

@section('content')

<div class="max-w-4xl mx-auto p-6">
    <div class="flex items-center justify-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Add Panel Lawyer</h2>
    </div>
</div>

<h3 class="text-sm font-semibold text-gray-500 mb-3">USER INFORMATION</h3>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <div>
        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
        <input type="text" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" id="first_name" />
    </div>
     <div>
        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
        <input type="text" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" id="last_name" />
    </div>
</div>
@endsection
