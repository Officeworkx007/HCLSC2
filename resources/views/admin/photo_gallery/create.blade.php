@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('page-title', 'Photo Gallery Creation')

@section('content')

<section class="p-8 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto">
        
        <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-300">
            <h1 class="text-3xl font-bold text-blue-900">
                🖼️ Create New Photo Album
            </h1>
            <a href="" 
               class="flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition">
               <i data-feather="list" class="w-4 h-4 mr-1"></i> Back to Albums List
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p class="font-bold">Please correct the following errors:</p>
                <ul class="list-disc ml-5 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="" method="POST" enctype="multipart/form-data" 
              class="bg-white p-6 rounded-xl shadow-2xl border border-gray-200">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div>
                    <div class="mb-5">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Album Title <span class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                               placeholder="e.g., National Lok Adalat, June 2026">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="event_date" class="block text-sm font-medium text-gray-700 mb-2">Event Date <span class="text-red-500">*</span></label>
                        <input type="date" id="event_date" name="event_date" value="{{ old('event_date', now()->toDateString()) }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500 @error('event_date') border-red-500 @enderror">
                        @error('event_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <div class="mb-5">
                        <label for="cover_photo" class="block text-sm font-medium text-gray-700 mb-2">Album Cover Photo <span class="text-red-500">*</span></label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md @error('cover_photo') border-red-500 @enderror">
                            <div class="space-y-1 text-center">
                                <i data-feather="image" class="mx-auto h-12 w-12 text-gray-400"></i>
                                <div class="flex text-sm text-gray-600">
                                    <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload a file</span>
                                        <input id="file-upload" name="cover_photo" type="file" class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB (600x400 recommended)</p>
                            </div>
                        </div>
                        @error('cover_photo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description (Optional)</label>
                <textarea id="description" name="description" rows="3"
                          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                          placeholder="A brief summary of the event or photos.">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200">
                <button type="submit"
                        class="w-full inline-flex justify-center py-3 px-4 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                    Create Album & Continue to Add Photos
                </button>
            </div>
        </form>
    </div>
</section>

<script>
    feather.replace();
    
    // Optional JS to show file name on selection
    const fileInput = document.getElementById('file-upload');
    const labelSpan = document.querySelector('label[for="file-upload"] span');
    
    if (fileInput && labelSpan) {
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                labelSpan.textContent = e.target.files[0].name;
            } else {
                labelSpan.textContent = 'Upload a file';
            }
        });
    }
</script>