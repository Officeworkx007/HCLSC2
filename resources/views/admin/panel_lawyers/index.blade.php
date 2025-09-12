@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('page-title', 'Panel Lawyers List')

@section('content')
    <div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-xl">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Panel Lawyers</h2>
            <a href=""
                class="flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Panel Lawyer
            </a>
        </div>

        <!--table creation-->
    </div>




@endsection
