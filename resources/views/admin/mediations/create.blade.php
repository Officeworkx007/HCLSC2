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
                Upload tomorrow’s mediation cause list and attach any notes for easy reference.
            </p>
        </div>

        <form action="{{ route('admin.mediations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            {{-- Cause List Date --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Cause List Date</label>
                <input type="date" name="cause_list_date"
                       value="{{ now()->addDay()->format('Y-m-d') }}"
                       class="w-full rounded-xl border border-gray-300 bg-gray-50 text-gray-900 p-3 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all duration-200"
                       required>
            </div>

            {{-- Description --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Description / Note</label>
                <textarea name="description" rows="4"
                          placeholder="Add any additional notes or remarks..."
                          class="w-full rounded-xl border border-gray-300 bg-gray-50 text-gray-900 p-3 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 resize-none transition-all duration-200"></textarea>
            </div>

            {{-- Upload PDF --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Upload PDF File</label>
                <div class="flex flex-col sm:flex-row items-center gap-4 bg-gray-100 p-4 rounded-xl border border-gray-200">
                    <input type="file" name="file" accept="application/pdf"
                           class="w-full text-gray-700 text-sm cursor-pointer bg-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-100 hover:file:bg-blue-200 transition-all duration-200"
                           required>
                </div>
                <p class="text-xs text-gray-400 mt-1">Only PDF files are accepted (max 10MB).</p>
            </div>

            {{-- Status --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Status</label>
                <select name="status"
                        class="w-full rounded-xl border border-gray-300 bg-gray-50 text-gray-900 p-3 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all duration-200">
                    <option value="upcoming" selected>Upcoming</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

            {{-- Submit --}}
            <div class="pt-4 flex justify-end">
                <button type="submit"
                        class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-blue-400 to-blue-500 hover:from-blue-500 hover:to-blue-600 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                    <i class="fa-solid fa-upload mr-2"></i> Upload Cause List
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
