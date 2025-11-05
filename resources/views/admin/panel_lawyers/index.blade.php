@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('page-title', 'Panel Lawyers List')

@section('content')
    <div class="w-full p-6 bg-white shadow-xl rounded-2xl">

        {{-- 🔔 Success/Error Message Display (Updated for Fade-out) --}}
        @if (session('success'))
            <div id="success-alert" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg shadow-md transition-opacity duration-500" role="alert">
                <p class="font-bold">Success</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Panel Lawyers</h2>
            <a href="{{ route('admin.panel_lawyers.create') }}"
                class="flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow-md hover:bg-indigo-700 transition transform hover:scale-[1.01]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Panel Lawyer
            </a>
        </div>

        {{-- ... (The rest of your table HTML remains the same) ... --}}
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table id="panelLawyersTable" class="min-w-full divide-y divide-gray-200 text-sm text-left text-gray-500">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Photo</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Phone Number</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Address</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">City</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pin Code</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse ($panelLawyers as $index => $lawyer)
                        {{-- ... (Table rows) ... --}}
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-700">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="h-10 w-10 rounded-full flex-shrink-0 overflow-hidden">
                                    @if ($lawyer->photo)
                                        <img class="h-full w-full object-cover"
                                            src="{{ asset('storage/' . $lawyer->photo) }}"
                                            alt="{{ $lawyer->first_name }} Photo">
                                    @else
                                        <div class="h-full w-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold text-sm border-2 border-dashed border-gray-400">
                                            {{ strtoupper(substr($lawyer->first_name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">
                                    {{ $lawyer->first_name }} {{ $lawyer->last_name }}
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ $lawyer->email ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $lawyer->phone_number ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $lawyer->address ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $lawyer->city ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $lawyer->pin_code ?? '-' }}</td>

                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href=""
                                        class="p-2 rounded-full bg-blue-50 hover:bg-blue-100 text-blue-600 transition"
                                        title="Edit">
                                        <i class="fas fa-pen text-blue-600 text-sm"></i>
                                    </a>

                                    <form action="{{ route('admin.panel_lawyers.destroy', $lawyer->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this lawyer and their photo?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 rounded-full bg-red-50 hover:bg-red-100 text-red-600 transition"
                                            title="Delete">
                                            <i class="fas fa-trash text-red-600 text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-10 text-center text-gray-500 text-lg">
                                No panel lawyers have been added yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // --- 1. Auto-Hide Alert Logic ---
                const alertElement = document.getElementById('success-alert');
                if (alertElement) {
                    // Hide the alert after 5000 milliseconds (5 seconds)
                    setTimeout(() => {
                        alertElement.style.opacity = '0';
                        // Remove element completely after fade out animation
                        setTimeout(() => {
                            alertElement.remove();
                        }, 500);
                    }, 5000);
                }

                // --- 2. DataTables Initialization Fix ---
                @if ($panelLawyers->isNotEmpty())
                    $('#panelLawyersTable').DataTable({
                        pageLength: 10,
                        lengthMenu: [5, 10, 25, 50],
                        ordering: true,
                        searching: true,
                        order: [
                            [0, 'asc']
                        ],
                        language: {
                            search: "Search Lawyers:",
                            lengthMenu: "Show _MENU_ entries per page",
                        }
                    });
                @endif
            });
        </script>
    @endpush
@endsection
