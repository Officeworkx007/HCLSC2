@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('page-title', 'Roles Creation')

@section('content')
    <div class="p-6 bg-white shadow-2xl rounded-xl max-w-4xl mx-auto mt-8">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-6 border-b pb-4">Create New User Role</h1>

        <form method="POST" action="{{ route('admin.roles.store') }}">
            @csrf

            {{-- Role Name Input --}}
            <div class="mb-6">
                <label for="name" class="block text-lg font-medium text-gray-700 mb-2">Role Name</label>
                <input type="text" name="name" id="name" required
                       class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-lg @error('name') border-red-500 @enderror"
                       placeholder="e.g., editor, moderator, super-admin" value="{{ old('name') }}">
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Permissions Section (Dynamic List) --}}
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 pt-4 border-t">Assign Permissions</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg shadow-inner">
                    {{-- Loop through permissions passed from the controller --}}
                    @forelse ($permissions as $groupName => $permissionGroup)
                        <div class="bg-white p-4 rounded-xl shadow border border-gray-100">
                            <h3 class="text-base font-bold text-indigo-700 mb-3 uppercase border-b pb-2">{{ Str::replace('_', ' ', $groupName) }}</h3>
                            <div class="space-y-2">
                                @foreach ($permissionGroup as $permission)
                                    <label class="flex items-center text-sm font-medium text-gray-600 cursor-pointer hover:bg-gray-50 p-1 rounded-md transition-colors">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                               class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                        <span class="ml-3">{{ Str::replace('_', ' ', $permission->name) }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="md:col-span-2 text-center py-4 text-gray-500 italic">No permissions available. Please run migrations/seeders.</div>
                    @endforelse
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="mt-8 pt-4 border-t">
                <button type="submit"
                        class="w-full px-6 py-3 bg-indigo-600 text-white font-bold text-lg rounded-lg shadow-xl hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50 transition duration-300 ease-in-out">
                    Save Role and Permissions
                </button>
            </div>
        </form>
    </div>
@endsection
