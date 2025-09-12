@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('page-title', 'Panel Lawyers List')

@section('content')
    <div class="w-full p-6 bg-white shadow-md rounded-xl">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Panel Lawyers</h2>
            <a href="{{ route('admin.panel_lawyers.create') }}"
                class="flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Panel Lawyer
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Phone Number</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Address</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">City</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Pin Code</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($panelLawyers as $lawyer)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                                        {{ strtoupper(substr($lawyer->first_name, 0, 1)) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-gray-900">
                                            {{ $lawyer->first_name }} {{ $lawyer->last_name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ $lawyer->email ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $lawyer->phone_number ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $lawyer->address ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $lawyer->city ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $lawyer->pin_code ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 text-center">
                                <div class="flex justify-center gap-3">
                                    <!-- Edit -->
                                    <a href=""
                                        class="p-2 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-600 transition"
                                        title="Edit">
                                        <i class="fas fa-pen text-blue-600"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this lawyer?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 transition"
                                            title="Delete">
                                            <i class="fas fa-trash text-red-600"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                No lawyers added yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
