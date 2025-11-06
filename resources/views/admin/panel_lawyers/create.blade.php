@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('page-title', 'Panel Lawyers Creation')

@section('content')
    <div class="max-w-6xl mx-auto p-4 md:p-8 bg-white shadow-xl rounded-2xl">
        {{-- IMPORTANT: Add enctype for file uploads --}}
        <form action="{{ route('admin.panel_lawyers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-col sm:flex-row items-center justify-between mb-8 border-b pb-4">
                <h2 class="text-2xl font-bold text-gray-800 mb-2 sm:mb-0">Add Panel Lawyer</h2>
                <span class="text-sm text-gray-500">Please fill in the required details</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- === 📸 Photo Upload Section (Fluid & Responsive) === --}}
                <div class="lg:col-span-1 flex flex-col items-center p-6 bg-gray-50 border border-gray-200 rounded-xl h-fit sticky top-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Lawyer Photo</h3>

                    {{-- Photo Frame --}}
                    <div id="photo-frame" class="w-48 h-48 border-4 border-dashed border-gray-300 rounded-xl flex items-center justify-center overflow-hidden mb-4 relative hover:border-indigo-500 transition-colors cursor-pointer">
                        <img id="photo-preview" class="hidden w-full h-full object-cover" src="" alt="Photo Preview">
                        <span id="upload-icon" class="text-gray-400 text-6xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175M4.833 9.407A2.08 2.08 0 0 0 3.39 12m0 0a2.08 2.08 0 0 0 1.444 2.593m0 0c.38.054.757.112 1.134.175M4.833 9.407A2.08 2.08 0 0 1 3.39 12m0 0a2.08 2.08 0 0 0 1.444 2.593c.48.07.957.135 1.44.195M12 21.75c-4.97 0-9-4.03-9-9s4.03-9 9-9c1.928 0 3.7.625 5.167 1.684M12 21.75c4.97 0 9-4.03 9-9s-4.03-9-9-9m0 16.5v-15.75" />
                            </svg>
                        </span>
                    </div>

                    {{-- Hidden file input, triggered by clicking the frame --}}
                    <input type="file" id="photo" name="photo" class="hidden" accept="image/*">
                    <label for="photo" class="cursor-pointer px-4 py-2 bg-indigo-500 text-white font-medium rounded-lg shadow-md hover:bg-indigo-600 transition">
                        Select Photo (Max 10MB)
                    </label>

                    {{-- Progress Bar (Hidden initially) --}}
                    <div id="progress-container" class="w-full mt-4 hidden">
                        <div class="text-xs font-semibold text-gray-600 mb-1" id="progress-text">Uploading... 0%</div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div id="progress-bar" class="bg-indigo-600 h-2.5 rounded-full transition-all duration-300 ease-out" style="width: 0%"></div>
                        </div>
                    </div>
                </div>

                {{-- === Form Fields Section (Two Columns) === --}}
                <div class="lg:col-span-2">

                    <h3 class="text-sm font-semibold text-gray-600 mb-4 uppercase tracking-wide">User Information</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}"
                                class="w-full border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition @error('first_name') border-red-500 @enderror" />
                            @error('first_name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}"
                                class="w-full border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition @error('last_name') border-red-500 @enderror" />
                            @error('last_name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        {{-- 🆕 NEW FIELD: Designation --}}
                        <div class="sm:col-span-2">
                            <label for="designation" class="block text-sm font-medium text-gray-700 mb-1">Designation</label>
                            <input type="text" id="designation" name="designation" value="{{ old('designation') }}"
                                class="w-full border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition @error('designation') border-red-500 @enderror" />
                            @error('designation') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="w-full border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition @error('email') border-red-500 @enderror" />
                            @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}"
                                class="w-full border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition @error('phone_number') border-red-500 @enderror" />
                            @error('phone_number') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <h3 class="text-sm font-semibold text-gray-600 mb-4 uppercase tracking-wide">Contact Information</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                        <div class="sm:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <input type="text" id="address" name="address" value="{{ old('address') }}"
                                class="w-full border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition @error('address') border-red-500 @enderror" />
                            @error('address') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                            <input type="text" id="city" name="city" value="{{ old('city') }}"
                                class="w-full border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition @error('city') border-red-500 @enderror" />
                            @error('city') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="pin_code" class="block text-sm font-medium text-gray-700 mb-1">Pin Code</label>
                            <input type="text" id="pin_code" name="pin_code" value="{{ old('pin_code') }}"
                                class="w-full border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition @error('pin_code') border-red-500 @enderror" />
                            @error('pin_code') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex justify-end pt-6 border-t mt-8">
                        <button type="submit"
                            class="px-8 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-lg transition duration-150 ease-in-out transform hover:scale-[1.01]">
                            Create Lawyer
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection

{{-- JavaScript for Photo Preview and Progress Bar --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.getElementById('photo');
        const photoPreview = document.getElementById('photo-preview');
        const uploadIcon = document.getElementById('upload-icon');
        const photoFrame = document.getElementById('photo-frame');
        const progressBar = document.getElementById('progress-bar');
        const progressContainer = document.getElementById('progress-container');
        const progressText = document.getElementById('progress-text');

        // 1. Photo Preview Logic
        fileInput.addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (file) {
                // Check for file size (10MB limit = 10 * 1024 * 1024 bytes)
                if (file.size > 10 * 1024 * 1024) {
                    alert('File size exceeds the 10MB limit.');
                    fileInput.value = ''; // Clear the input
                    return;
                }

                // Show the progress bar simulation
                simulateProgress();

                // Show the preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    photoPreview.src = e.target.result;
                    photoPreview.classList.remove('hidden');
                    uploadIcon.classList.add('hidden');
                    photoFrame.classList.remove('border-dashed'); // Make the frame solid once an image is uploaded
                };
                reader.readAsDataURL(file);
            } else {
                // Hide preview if no file is selected
                photoPreview.src = '';
                photoPreview.classList.add('hidden');
                uploadIcon.classList.remove('hidden');
                photoFrame.classList.add('border-dashed');
                progressContainer.classList.add('hidden');
            }
        });

        // Make the entire frame clickable to open the file dialog
        photoFrame.addEventListener('click', function() {
            fileInput.click();
        });

        // 2. Progress Bar Simulation (for standard form submission)
        function simulateProgress() {
            progressContainer.classList.remove('hidden');
            let width = 0;
            const interval = setInterval(function() {
                if (width >= 99) {
                    clearInterval(interval);
                    progressText.textContent = 'Ready to Submit';
                } else {
                    width += 5; // Increase in steps
                    progressBar.style.width = width + '%';
                    progressText.textContent = `Uploading... ${width}%`;
                }
            }, 100); // Fast simulation for user feedback
        }
    });
</script>
@endpush
