@extends('admin.layouts.master')

@section('title', 'Create Role')
@section('page-title', 'Role Management')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center px-4">
    <div class="w-full max-w-2xl bg-white shadow-2xl rounded-2xl p-8">

        {{-- Header --}}
        <div class="text-center mb-8 border-b pb-4">
            <h2 class="text-2xl font-bold text-gray-800">Create New Role</h2>
            <p class="text-sm text-gray-500 mt-1">
                Define a role to assign permissions later
            </p>
        </div>

        {{-- Form --}}
        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf

            {{-- Role Name --}}
            <div class="mb-6">
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Role Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="e.g. Admin, Editor, Clerk"
                    class="w-full rounded-xl border-gray-300 px-4 py-3 shadow-sm
                           focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                           transition @error('name') border-red-500 @enderror"
                >

                @error('name')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Info Card --}}
            <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-4 text-sm text-indigo-700 mb-6">
                Permissions will be assigned to this role after creation.
            </div>

            {{-- Actions --}}
            <div class="flex justify-center pt-4">
                <button
                    type="submit"
                    class="px-10 py-3 bg-indigo-600 text-white font-semibold
                           rounded-xl shadow-lg hover:bg-indigo-700
                           transition transform hover:scale-[1.02]"
                >
                    Create Role
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
