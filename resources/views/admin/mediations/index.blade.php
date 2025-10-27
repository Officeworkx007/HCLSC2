@extends('admin.layouts.master')

@section('title', 'Mediation Cause Lists')

@section('page-title', 'Mediation Cause Lists')

@section('content')

    <div class="px-4 sm:px-6 lg:px-8 py-10 bg-white min-h-[80vh]">
        <div class="mx-auto bg-white rounded-2xl shadow-lg p-4 sm:p-8 xl:p-10 max-w-[95vw] xl:max-w-[90rem]">

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">All Mediation Cause Lists</h2>
                <a href="{{ route('admin.mediations.create') }}"
                    class="px-4 py-2 bg-[#09d8f3] !text-white font-semibold rounded-lg border border-black
           shadow-md hover:bg-[#00F5D4] hover:!text-white hover:shadow-[0_0_15px_#00F5D4]
           focus:ring-2 focus:ring-[#00F5D4] focus:ring-offset-2
           transition-all duration-300 ease-in-out">
                    + Upload New
                </a>
            </div>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto w-full">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Date</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">To Be Held On</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Description</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">PDF File</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Uploaded By</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Upload Time</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($causeLists as $list)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                {{-- Cause List Order Date --}}
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    {{ $list->cause_list_date ? \Carbon\Carbon::parse($list->cause_list_date)->format('d M Y') : '-' }}
                                </td>

                                {{-- To be Held on Date --}}
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    {{ $list->to_be_held_on ? \Carbon\Carbon::parse($list->to_be_held_on)->format('d M Y') : '-' }}
                                </td>

                                {{-- Description --}}
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $list->description ?? '-' }}</td>

                                {{-- PDF --}}
                                <td class="px-4 py-3 text-sm text-gray-700 flex items-center gap-2">
                                    @if ($list->file_path)
                                        <a href="{{ asset('storage/' . $list->file_path) }}" target="_blank"
                                            class="flex items-center gap-2 hover:text-blue-600 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M6 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6H6zM13 3.5L18.5 9H14a1 1 0 0 1-1-1V3.5z" />
                                            </svg>
                                            <span class="truncate max-w-[150px]">{{ basename($list->file_path) }}</span>
                                        </a>
                                    @else
                                        <span class="text-gray-400 italic">No file</span>
                                    @endif
                                </td>

                                {{-- Status --}}
                                <td class="px-4 py-3 text-sm">
                                    @php
                                        $heldDate = \Carbon\Carbon::parse($list->to_be_held_on);
                                        $now = now();

                                        if ($now->lt($heldDate->copy()->setTime(11, 0, 0))) {
                                            $status = 'upcoming';
                                            $badgeColor = 'bg-yellow-100 text-yellow-800';
                                        } elseif (
                                            $now->between(
                                                $heldDate->copy()->setTime(11, 0, 0),
                                                $heldDate->copy()->setTime(18, 0, 0),
                                            )
                                        ) {
                                            $status = 'ongoing';
                                            $badgeColor = 'bg-blue-100 text-blue-800';
                                        } else {
                                            $status = 'completed';
                                            $badgeColor = 'bg-green-100 text-green-800';
                                        }
                                    @endphp

                                    <span
                                        class="inline-block px-3 py-1 text-xs font-semibold rounded-full {{ $badgeColor }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>


                                {{-- Uploaded By --}}
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    {{ $list->uploader->name ?? 'Admin' }}
                                </td>

                                {{-- Upload Time --}}
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    {{ $list->created_at->format('d M Y, h:i A') }}
                                </td>

                                {{-- Actions --}}
                                <td class="px-4 py-3 text-sm flex gap-2">
                                    <a href="{{ route('admin.mediations.edit', $list->id) }}"
                                        class="flex items-center gap-1 px-3 py-1.5 text-sm bg-white border border-[#4B006E] hover:bg-white text-black rounded-md transition">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.mediations.destroy', $list->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this cause list?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="flex items-center gap-1 px-3 py-1.5 text-sm bg-[#4B006E] hover:bg-[#7205a5] text-white rounded-md transition">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-6 text-center text-gray-400 italic">
                                    No mediation cause lists found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>
@endsection
