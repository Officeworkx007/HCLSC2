@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('page-title', 'Create Notices')

@section('content')
    <div class="max-w-3xl mx-auto mt-10 bg-white shadow-xl rounded-2xl p-8">

        <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-2">
            <i class="fas fa-bullhorn text-indigo-600"></i>
            Create New Notice
        </h2>

        {{-- Success/Error Messages --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                <ul class="list-disc ml-6">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.notices.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                <input type="text" name="description" id="description" value="{{ old('description') }}"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Order No --}}
            <div>
                <label for="order_no" class="block text-sm font-semibold text-gray-700 mb-2">Order No</label>
                <input type="text" name="order_no" id="order_no" value="{{ old('order_no') }}"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            {{-- Notice Date --}}
            <div>
                <label for="notice_date" class="block text-sm font-semibold text-gray-700 mb-2">Notice Date</label>
                <input type="date" name="notice_date" id="notice_date" value="{{ old('notice_date') }}"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- PDF Upload --}}
            <div>
                <label for="pdf" class="block text-sm font-semibold text-gray-700 mb-2">Upload Notice PDF</label>
                <input type="file" name="pdf" id="pdf" accept="application/pdf"
                    class="w-full border border-gray-300 rounded-lg p-3 bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <p class="text-sm text-gray-500 mt-1">Only PDF files allowed. Max size: 5MB</p>
            </div>

            {{-- Submit Button --}}
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-3 rounded-lg shadow hover:bg-indigo-700 transition">
                    <i class="fas fa-save mr-2"></i> Save Notice
                </button>
            </div>
        </form>
    </div>
@endsection
