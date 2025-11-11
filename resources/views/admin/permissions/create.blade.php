@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('page-title', 'Permission Creation')

@section('content')
    <div class="p-6 bg-white shadow-2xl rounded-xl max-w-2xl mx-auto mt-8">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-6 border-b pb-4">Define New Permission</h1>

        <form method="POST" action="{{ route('admin.permissions.store') }}">
            @csrf

            {{-- Permission Name Input --}}
            <div class="mb-6">
                <label for="name" class="block text-lg font-medium text-gray-700 mb-2">Permission Name</label>
                <input type="text" name="name" id="name" required
                       class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 text-lg @error('name') border-red-500 @enderror"
                       placeholder="e.g., view users, delete posts, edit settings" value="{{ old('name') }}">

                <p class="mt-2 text-sm text-gray-500">
                    Use lowercase and descriptive, simple phrases (e.g., action resource).
                </p>

                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="mt-8 pt-4 border-t">
                <button type="submit"
                        class="w-full px-6 py-3 bg-green-600 text-white font-bold text-lg rounded-lg shadow-xl hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-500 focus:ring-opacity-50 transition duration-300 ease-in-out">
                    Save Permission
                </button>
            </div>
        </form>
    </div>
@endsection
