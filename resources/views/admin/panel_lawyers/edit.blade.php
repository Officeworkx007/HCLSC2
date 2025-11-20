@extends('admin.layouts.master')

@section('title', 'Edit Panel Lawyer')

@section('page-title', 'Edit Panel Lawyer')

@section('content')
    <div class="w-full max-w-4xl mx-auto p-8 bg-white shadow-xl rounded-2xl">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 border-b pb-4">
            Editing: {{ $lawyer->first_name }} {{ $lawyer->last_name }}
        </h2>

        {{-- Form: Points to the update route with the lawyer ID --}}
        <form action="{{ route('admin.panel_lawyers.update', $lawyer->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- Use the PUT method for updates --}}
            @method('PUT')

            <div class="space-y-6">

                {{-- Name --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name <span class="text-red-500">*</span></label>
                        <input type="text" name="first_name" id="first_name" required
                               value="{{ old('first_name', $lawyer->first_name) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 @error('first_name') border-red-500 @enderror">
                        @error('first_name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name <span class="text-red-500">*</span></label>
                        <input type="text" name="last_name" id="last_name" required
                               value="{{ old('last_name', $lawyer->last_name) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 @error('last_name') border-red-500 @enderror">
                        @error('last_name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- 🆕 Designation & Bar Enrolment No --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="designation" class="block text-sm font-medium text-gray-700 mb-1">Designation</label>
                        <input type="text" name="designation" id="designation"
                               value="{{ old('designation', $lawyer->designation) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 @error('designation') border-red-500 @enderror">
                        @error('designation')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="enrolment_no" class="block text-sm font-medium text-gray-700 mb-1">Bar Enrolment No</label>
                        <input type="text" name="enrolment_no" id="enrolment_no"
                               value="{{ old('enrolment_no', $lawyer->enrolment_no) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 @error('designation') border-red-500 @enderror">
                        @error('enrolment_no')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Contact Fields --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email"
                               value="{{ old('email', $lawyer->email) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number"
                               value="{{ old('phone_number', $lawyer->phone_number) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 @error('phone_number') border-red-500 @enderror">
                        @error('phone_number')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Address Fields (City/Pin Code) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                        <input type="text" name="city" id="city"
                               value="{{ old('city', $lawyer->city) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 @error('city') border-red-500 @enderror">
                        @error('city')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="pin_code" class="block text-sm font-medium text-gray-700 mb-1">Pin Code</label>
                        <input type="text" name="pin_code" id="pin_code"
                               value="{{ old('pin_code', $lawyer->pin_code) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 @error('pin_code') border-red-500 @enderror">
                        @error('pin_code')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Address Textarea --}}
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <textarea name="address" id="address" rows="3"
                                 class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 @error('address') border-red-500 @enderror">{{ old('address', $lawyer->address) }}</textarea>
                    @error('address')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Photo Field and Current Photo Display --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Update Photo (Max 10MB)</label>
                        <input type="file" name="photo" id="photo"
                               class="block w-full text-sm text-gray-500
                               file:mr-4 file:py-2 file:px-4
                               file:rounded-full file:border-0
                               file:text-sm file:font-semibold
                               file:bg-indigo-50 file:text-indigo-700
                               hover:file:bg-indigo-100 @error('photo') border-red-500 @enderror">
                        @error('photo')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Uploading a new file will replace the current one.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Current Photo</label>
                        @if ($lawyer->photo)
                            <div class="flex items-center space-x-4">
                                <img src="{{ asset('storage/' . $lawyer->photo) }}" alt="Current Photo"
                                     class="h-16 w-16 rounded-full object-cover border border-gray-300">
                                <span class="text-sm text-gray-600">Existing photo will be replaced.</span>
                            </div>
                        @else
                            <div class="h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 text-xs border border-dashed border-gray-400">
                                No Photo
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end pt-4 border-t mt-8 space-x-3">
                    <a href="{{ route('admin.panel_lawyers.index') }}"
                       class="px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow-md hover:bg-indigo-700 transition transform hover:scale-[1.01]">
                        <i class="fas fa-save mr-2"></i> **Update Lawyer**
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
