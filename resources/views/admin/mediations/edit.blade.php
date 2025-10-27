@extends('admin.layouts.master')

@section('title', 'Edit Mediation Cause List')

@section('page-title', 'Edit Mediation Cause List')

@section('content')
    <div class="min-h-[80vh] flex items-center justify-center py-10 px-4 bg-gray-50">
        <div class="w-full max-w-3xl bg-white rounded-2xl shadow-xl p-8 sm:p-10 border border-gray-200">

            <div class="text-center mb-8">
                <h2 class="text-3xl sm:text-4xl font-bold tracking-wide mb-2 text-gray-800">
                    ✏️ Edit Mediation Cause List
                </h2>
                <p class="text-gray-500 text-sm sm:text-base">
                    Update the existing mediation cause list details or replace the uploaded file.
                </p>
            </div>

            <form action="{{ route('admin.mediations.update', $mediation->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                {{-- Cause List Date --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Cause List Order Date</label>
                    <input type="date" name="cause_list_date"
                        value="{{ old('cause_list_date', $mediation->cause_list_date ? \Carbon\Carbon::parse($mediation->cause_list_date)->format('Y-m-d') : '') }}"
                        class="w-full rounded-xl border border-gray-300 bg-gray-50 text-gray-900 p-3 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all duration-200"
                        required>
                </div>

                {{-- To be Held on Date --}}
                <div class="mb-4">
                    <label for="to_be_held_on" class="block text-sm font-medium text-gray-700 mb-1">To Be Held On</label>
                    <input type="date" name="to_be_held_on" id="to_be_held_on"
                        value="{{ old('to_be_held_on', $mediation->to_be_held_on ? \Carbon\Carbon::parse($mediation->to_be_held_on)->format('Y-m-d') : '') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                {{-- Description --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Description / Note</label>
                    <textarea name="description" rows="4" placeholder="Add any additional notes or remarks..."
                        class="w-full rounded-xl border border-gray-300 bg-gray-50 text-gray-900 p-3 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 resize-none transition-all duration-200">{{ old('description', $mediation->description) }}</textarea>
                </div>

                {{-- Existing File --}}
                @if ($mediation->file_path)
                    <div class="flex items-center justify-between bg-gray-50 p-3 border rounded-xl">
                        <p class="text-sm text-gray-700 truncate">
                            <i class="fa-solid fa-file-pdf text-red-500 mr-2"></i>
                            <a href="{{ asset('storage/' . $mediation->file_path) }}" target="_blank"
                               class="hover:text-blue-600 underline">
                                {{ basename($mediation->file_path) }}
                            </a>
                        </p>
                        <span class="text-xs text-gray-400">(Current file)</span>
                    </div>
                @endif

                {{-- Upload New PDF (Optional) --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Replace PDF File (optional)</label>
                    <div class="flex flex-col sm:flex-row items-center gap-4 bg-gray-100 p-4 rounded-xl border border-gray-200">
                        <input type="file" name="file" accept="application/pdf"
                            class="w-full text-gray-700 text-sm cursor-pointer bg-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-100 hover:file:bg-blue-200 transition-all duration-200">
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Leave blank to keep existing PDF.</p>
                </div>

                {{-- Status --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Status</label>
                    <select name="status"
                        class="w-full rounded-xl border border-gray-300 bg-gray-50 text-gray-900 p-3 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all duration-200">
                        <option value="upcoming" {{ old('status', $mediation->status) === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="completed" {{ old('status', $mediation->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                {{-- Submit --}}
                <div class="pt-4 flex justify-end">
                    <button type="submit"
                        class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-green-400 to-green-500 hover:from-green-500 hover:to-green-600 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                        <i class="fa-solid fa-save mr-2"></i> Update Cause List
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
