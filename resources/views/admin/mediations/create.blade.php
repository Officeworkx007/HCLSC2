@extends('admin.layouts.master')

@section('title', 'Upload Mediation Cause List')
@section('page-title', 'Upload Mediation Cause List')

@section('content')
    <div class="min-h-[80vh] flex items-center justify-center py-10 px-4 bg-gray-50">
        <div class="w-full max-w-3xl bg-white rounded-2xl shadow-xl p-8 sm:p-10 border border-gray-200">

            <div class="text-center mb-8">
                <h2 class="text-3xl sm:text-4xl font-bold tracking-wide mb-2 text-gray-800">
                    🧾 Upload Mediation Cause List
                </h2>
                <p class="text-gray-500 text-sm sm:text-base">
                    Upload mediation cause list and attach any notes for easy reference.
                </p>
            </div>

            {{-- Display general success or error messages (like auth errors) --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-4" role="alert">
                    <p class="font-bold">Success!</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            @endif
            @if($errors->has('auth'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4" role="alert">
                    <p class="font-bold">Authentication Error!</p>
                    <p class="text-sm">{{ $errors->first('auth') }}</p>
                </div>
            @endif

            <form action="{{ route('admin.mediations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                {{-- Cause List Date --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Cause List Order Date</label>
                    <input type="date" name="cause_list_date" value="{{ old('cause_list_date', now()->format('Y-m-d')) }}"
                        class="w-full rounded-xl border border-gray-300 bg-gray-50 text-gray-900 p-3
                                @error('cause_list_date') border-red-500 @else focus:ring-2 focus:ring-blue-400 focus:border-blue-400 @enderror transition-all duration-200"
                        required>
                    @error('cause_list_date')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- To be Held on Date --}}
                <div>
                    <label for="to_be_held_on" class="block mb-2 text-sm font-medium text-gray-700">To Be Held On</label>
                    <input type="date" name="to_be_held_on" id="to_be_held_on" required value="{{ old('to_be_held_on') }}"
                        class="w-full rounded-xl border border-gray-300 bg-gray-50 text-gray-900 p-3
                                @error('to_be_held_on') border-red-500 @else focus:ring-2 focus:ring-blue-400 focus:border-blue-400 @enderror transition-all duration-200">
                    @error('to_be_held_on')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Description / Note</label>
                    <textarea name="description" rows="4" placeholder="Add any additional notes or remarks..."
                        class="w-full rounded-xl border border-gray-300 bg-gray-50 text-gray-900 p-3
                                @error('description') border-red-500 @else focus:ring-2 focus:ring-blue-400 focus:border-blue-400 @enderror resize-none transition-all duration-200">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Upload PDF --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Upload PDF File</label>

                    {{-- File Error Display --}}
                    @error('file')
                        <p class="text-sm text-red-500 mt-1 mb-2 font-semibold">{{ $message }}</p>
                    @enderror

                    <div class="flex flex-col sm:flex-row items-center gap-4 bg-gray-100 p-4 rounded-xl border border-gray-200">
                        <input type="file" name="file" accept="application/pdf"
                            class="w-full text-gray-700 text-sm cursor-pointer bg-transparent
                                    file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                                    file:text-sm file:font-semibold file:bg-blue-100 hover:file:bg-blue-200
                                    transition-all duration-200"
                            required>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Only PDF files are accepted (max 10MB).</p>
                </div>

                {{-- Auto status notice --}}
                <div class="text-sm text-gray-500 italic">
                    Status will be set automatically based on the “To Be Held On” date and time.
                </div>

                {{-- Submit --}}
                <div class="pt-4 flex justify-end">
                    <button type="submit"
                        class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-[#09d8f3] to-[#00F5D4]
                                hover:from-[#00F5D4] hover:to-[#09d8f3] text-white font-semibold
                                rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-0.5
                                transition-all duration-200">
                        <i class="fa-solid fa-upload mr-2"></i> Upload Cause List
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
