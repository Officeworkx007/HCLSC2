@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('page-title', 'View Notices')

@section('content')
    <div class="bg-white shadow-xl rounded-2xl p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-bullhorn text-indigo-600"></i> Notices
            </h2>
            <a href="{{ route('admin.notices.create') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 transition">
                <i class="fas fa-plus mr-2"></i> Add Notice
            </a>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Sl No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Description</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Order No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Date</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">PDF</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($notices as $index => $notice)
                        <tr class="hover:bg-gray-50">
                            {{-- Sl No --}}
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $index + 1 }}</td>

                            {{-- Description --}}
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $notice->description }}</td>

                            {{-- Order No --}}
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $notice->order_no }}</td>

                            {{-- Date --}}
                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($notice->notice_date)->format('d-m-Y') }}
                            </td>

                            {{-- PDF Link --}}
                            <td class="px-4 py-3 text-sm">
                                @if ($notice->pdf_path)
                                    <a href="{{ asset('storage/' . $notice->pdf_path) }}" target="_blank"
                                        class="text-indigo-600 hover:underline flex items-center gap-1">
                                        <i class="fas fa-file-pdf"></i> View PDF
                                    </a>
                                @else
                                    <span class="text-gray-400">No File</span>
                                @endif
                            </td>

                            {{-- Status Toggle --}}
                            <td class="px-4 py-3">
                                <a href="{{ route('admin.notices.toggle-status', $notice->id) }}"
                                    class="px-3 py-1 rounded-full text-sm font-semibold
                                    {{ $notice->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $notice->status ? 'Active' : 'Inactive' }}
                                </a>
                            </td>

                            {{-- Actions --}}
                            <td class="px-4 py-3 flex items-center gap-3">
                                {{-- Edit --}}
                                <a href="" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-edit"></i>
                                </a>
                                {{-- Delete --}}
                                <form action="" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this notice?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                                No notices found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $notices->links() }}
        </div>
    </div>
@endsection
