@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('page-title', 'Photo Gallery Management')

@section('content')

    <section class="p-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto">

            <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-300">
                <h1 class="text-3xl font-bold text-blue-900 flex items-center">
                    <i data-feather="image" class="w-7 h-7 mr-3 text-blue-700"></i> Album Management
                </h1>
                <a href="{{ route('admin.photo_gallery.create') }}"
                    class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150">
                    <i data-feather="plus" class="w-4 h-4 mr-2"></i> Create New Album
                </a>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            {{-- Search and Filter Placeholder --}}
            <div class="mb-6 flex space-x-4">
                <input type="text" placeholder="Search albums by title..."
                    class="flex-grow p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <select class="p-2 border border-gray-300 rounded-md shadow-sm">
                    <option>Sort by Date (Newest)</option>
                    <option>Sort by Date (Oldest)</option>
                    <option>Sort by Photo Count</option>
                </select>
            </div>

            <div class="bg-white rounded-xl shadow-2xl overflow-hidden border border-gray-200">

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-blue-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Album Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Event Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Photos</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Created At</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($albums as $album)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-blue-900">{{ $album->title }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $album->event_date->format('F d, Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            {{ $album->photos_count }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $album->created_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">

                                        {{-- Button Container: Use standard inline-block for spacing between elements --}}
                                        <div class="space-x-2 flex justify-center items-center">

                                            {{-- 1. VIEW Button (Blue) --}}
                                            <a href="{{ route('admin.photo_gallery.show', $album) }}"
                                                class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition duration-150"
                                                title="View Album Photos">
                                                {{-- Assuming Font Awesome is available, otherwise use data-feather="eye" --}}
                                                <i class="fa fa-eye w-4 h-4 mr-1"></i> View
                                            </a>

                                            {{-- 2. EDIT Button (Gray/Disabled Placeholder) --}}
                                            <span
                                                class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-gray-400 cursor-default"
                                                title="Edit Album Details (Coming Soon)">
                                                {{-- Assuming Font Awesome is available, otherwise use data-feather="edit" --}}
                                                <i class="fa fa-edit w-4 h-4 mr-1"></i> Edit
                                            </span>

                                            {{-- 3. DELETE Button (Red) --}}
                                            <form action="" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Are you sure you want to delete the album: {{ $album->title }}? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-red-600 hover:bg-red-700 transition duration-150"
                                                    title="Delete Album">
                                                    {{-- Assuming Font Awesome is available, otherwise use data-feather="trash-2" --}}
                                                    <i class="fa fa-trash-alt w-4 h-4 mr-1"></i> Delete
                                                </button>
                                            </form>
                                        </div> {{-- End of container --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        <i data-feather="info" class="w-6 h-6 inline mr-2"></i> No photo albums found. Start
                                        by creating a new one!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($albums->hasPages())
                    <div class="p-4 border-t border-gray-200">
                        {{ $albums->links() }}
                    </div>
                @endif

            </div>

        </div>
    </section>

@endsection

@section('scripts')
    <script>
        feather.replace();
    </script>
@endsection
