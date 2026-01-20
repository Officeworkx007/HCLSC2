@extends('admin.layouts.master')

@section('title', 'Roles')
@section('page-title', 'Roles Management')

@section('content')
    <div class="max-w-6xl mx-auto bg-white shadow-xl rounded-2xl overflow-hidden">

        {{-- Header --}}
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Roles & Permissions</h2>
                <p class="text-sm text-gray-500">Manage system roles and access control</p>
            </div>

            <a href="{{ route('admin.roles.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                + Create Role
            </a>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="text-left px-6 py-3 font-semibold">Role</th>
                        <th class="text-left px-6 py-3 font-semibold">Permissions</th>
                        <th class="text-right px-6 py-3 font-semibold">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach ($roles as $role)
                        <tr class="hover:bg-gray-50 transition">

                            {{-- Role name --}}
                            <td class="px-6 py-4 font-semibold capitalize">
                                {{ $role->name }}
                                @if ($role->name === 'admin')
                                    <span
                                        class="ml-2 px-2 py-0.5 text-xs bg-green-100 text-green-700 rounded-full">
                                        Super Admin
                                    </span>
                                @endif
                            </td>

                            {{-- Permissions --}}
                            <td class="px-6 py-4">
                                @if ($role->name === 'admin')
                                    <div class="flex flex-wrap gap-2">
                                        @foreach (\Spatie\Permission\Models\Permission::all() as $permission)
                                            <span
                                                class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">
                                                {{ $permission->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @elseif ($role->permissions->count())
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($role->permissions as $permission)
                                            <span
                                                class="px-2 py-1 text-xs bg-indigo-100 text-indigo-700 rounded-full">
                                                {{ $permission->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-xs text-gray-400 italic">
                                        No permissions assigned
                                    </span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4 text-right space-x-4">
                                @if ($role->name !== 'admin')
                                    <a href=""
                                        class="text-indigo-600 hover:underline">
                                        Edit
                                    </a>

                                    <form action=""
                                        method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            onclick="return confirm('Are you sure you want to delete this role?')"
                                            class="text-red-600 hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-gray-400 italic">
                                        Protected
                                    </span>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
