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
                <a href="{{ route('admin.photo_gallery.index')}}" class="flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition">
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

            <div class="bg-white p-6 rounded-xl shadow-2xl border border-gray-200" x-data="{
                currentStep: 1,
                title: '{{ old('title') }}',
                eventDate: '{{ old('event_date', now()->toDateString()) }}',
                description: '{{ old('description') }}',
                files: [],

                get fileSelectionLabel() {
                    if (this.files.length > 0) {
                        const count = this.files.length;
                        return `${count} file${count > 1 ? 's' : ''} selected`;
                    }
                    return 'Click to Select Multiple Files';
                },

                checkStep1AndGoToStep2() {
                    if (!this.title.trim() || !this.eventDate.trim()) {
                        alert('Please enter the Album Title and Event Date before proceeding.');
                        return;
                    }
                    this.currentStep = 2;
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                },

                handleFileSelect(event) {
                    const inputFiles = event.target.files;
                    this.files = Array.from(inputFiles).map(file => ({
                        name: file.name,
                        size: file.size,
                        originalFile: file
                    }));
                    this.updateFileInput(event.target);
                },

                removeFile(index) {
                    this.files.splice(index, 1);
                    this.updateFileInput(document.getElementById('file-upload-step2'));
                },

                updateFileInput(inputElement) {
                    const dataTransfer = new DataTransfer();
                    this.files.forEach(fileData => {
                        dataTransfer.items.add(fileData.originalFile);
                    });
                    inputElement.files = dataTransfer.files;
                }
            }">

                <div class="mb-10 flex justify-center space-x-8">
                    <div class="flex flex-col items-center cursor-pointer" @click="currentStep = 1">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 transition duration-300"
                            :class="{
                                'bg-blue-600 border-blue-600 text-white shadow-lg': currentStep >=
                                    1,
                                'border-gray-300 text-gray-500': currentStep < 1
                            }">
                            1
                        </div>
                        <span class="text-sm mt-2"
                            :class="{ 'text-blue-600 font-semibold': currentStep >= 1, 'text-gray-500': currentStep < 1 }">Album
                            Details</span>
                    </div>

                    <div class="w-1/4 h-0.5 mt-5 bg-gray-300 transition duration-300"
                        :class="{ 'bg-blue-600': currentStep >= 2 }"></div>

                    <div class="flex flex-col items-center cursor-pointer" @click="currentStep = 2">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 transition duration-300"
                            :class="{
                                'bg-blue-600 border-blue-600 text-white shadow-lg': currentStep >=
                                    2,
                                'border-gray-300 text-gray-500': currentStep < 2
                            }">
                            2
                        </div>
                        <span class="text-sm mt-2"
                            :class="{ 'text-blue-600 font-semibold': currentStep >= 2, 'text-gray-500': currentStep < 2 }">Upload
                            Photos</span>
                    </div>
                </div>

                <form id="album-form" action="{{ route('admin.photo_gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div x-show="currentStep === 1" class="space-y-6">
                        <h2 class="text-xl font-semibold text-gray-700 mb-6">Step 1: Basic Information</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Album Title <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="title" name="title" x-model="title" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                                    placeholder="e.g., National Lok Adalat, June 2026">
                                @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="event_date" class="block text-sm font-medium text-gray-700 mb-2">Event Date
                                    <span class="text-red-500">*</span></label>
                                <input type="date" id="event_date" name="event_date" x-model="eventDate" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500 @error('event_date') border-red-500 @enderror">
                                @error('event_date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description
                                (Optional)</label>
                            <textarea id="description" name="description" rows="3" x-model="description"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                                placeholder="A brief summary of the event or photos."></textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
                            <button type="button" @click="checkStep1AndGoToStep2()"
                                class="inline-flex items-center py-3 px-8 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                                Next: Upload Photos <i data-feather="arrow-right" class="w-5 h-5 ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <div x-show="currentStep === 2" x-cloak class="space-y-8">
                        <h2 class="text-xl font-semibold text-gray-700 mb-6">Step 2: Upload Album Photos</h2>

                        <div>
                            <label for="album_photos" class="block text-sm font-medium text-gray-700 mb-2">Select
                                Photos</label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-10 pb-10 border-2 border-yellow-500 border-dashed bg-yellow-50 rounded-md">
                                <div class="space-y-1 text-center">
                                    <i data-feather="upload-cloud" class="mx-auto h-16 w-16 text-yellow-600"></i>
                                    <div class="flex flex-col text-sm text-gray-600">
                                        <label for="file-upload-step2"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 p-2 border border-gray-300 shadow-sm">
                                            <span x-text="fileSelectionLabel" id="step2-file-name">Click to Select Multiple
                                                Files</span>
                                            <input id="file-upload-step2" name="album_photos[]" type="file" multiple
                                                class="sr-only" @change="handleFileSelect($event)">
                                        </label>
                                        <p class="pt-2">or drag and drop your photos here</p>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-3">Supports JPG/PNG/JPEG. Hold **Ctrl/Cmd** to select
                                        multiple files.</p>
                                </div>
                            </div>
                        </div>

                        <div x-show="files.length > 0" x-cloak
                            class="border border-gray-200 rounded-lg p-4 shadow-inner bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-700 mb-3">
                                <span x-text="files.length"></span> File(s) Ready to Upload
                            </h3>
                            <ul class="divide-y divide-gray-200 max-h-60 overflow-y-auto">
                                <template x-for="(file, index) in files" :key="index">
                                    <li class="py-3 flex justify-between items-center text-sm">
                                        <span class="flex items-center w-full truncate mr-4">
                                            <i data-feather="image" class="w-4 h-4 text-green-500 mr-2 flex-shrink-0"></i>
                                            <span class="truncate" x-text="file.name"></span>
                                            <span class="ml-2 text-xs text-gray-500 flex-shrink-0"
                                                x-text="`(${(file.size / 1024 / 1024).toFixed(2)} MB)`"></span>
                                        </span>

                                        <div class="flex items-center flex-shrink-0 w-1/3 min-w-40">
                                            <div class="w-full bg-gray-200 rounded-full h-1.5 mr-3">
                                                <div class="bg-blue-600 h-1.5 rounded-full" style="width: 100%;"></div>
                                            </div>

                                            <button type="button" @click="removeFile(index)"
                                                class="text-red-700 hover:text-red-900 transition flex items-center p-1 flex-shrink-0"
                                                title="Remove file">
                                                <i class="fa-solid fa-xmark text-lg font-extrabold"></i>
                                            </button>
                                        </div>
                                    </li>
                                </template>
                            </ul>
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-200 flex justify-between">
                            <button type="button" @click="currentStep = 1"
                                class="inline-flex items-center py-3 px-6 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                                <i data-feather="arrow-left" class="w-5 h-5 mr-2"></i> Previous
                            </button>

                            <button type="submit" :disabled="files.length === 0"
                                class="inline-flex justify-center py-3 px-8 border border-transparent shadow-sm text-base font-medium rounded-md text-white transition duration-150"
                                :class="{
                                    'bg-green-600 hover:bg-green-700 focus:ring-green-500': files.length >
                                        0,
                                    'bg-gray-400 cursor-not-allowed': files.length === 0
                                }">
                                <i data-feather="check-circle" class="w-5 h-5 mr-2"></i> Create Album & Save Photos
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        feather.replace();

        // Note: All Alpine logic is now inline within the x-data attribute on the div.
        // Ensure you include the Alpine.js CDN in your master layout for this to work.
    </script>

@endsection
