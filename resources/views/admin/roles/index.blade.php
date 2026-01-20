@extends('admin.layouts.master')

@section('title', 'Roles')
@section('page-title', 'Roles Management')

@section('content')
<div class="flex justify-end mb-4">
    <a href="{{ route('admin.roles.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded">
        + Create Role
    </a>
</div>

<div class="bg-white rounded shadow">
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3">Role</th>
                <th class="p-3">Permissions</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr class="border-t">
                <td class="p-3 font-semibold">{{ $role->name }}</td>

                <td class="p-3">
                    @foreach($role->permissions as $permission)
                        <span class="text-xs bg-gray-200 px-2 py-1 rounded mr-1">
                            {{ $permission->name }}
                        </span>
                    @endforeach
                </td>

                <td class="p-3">
                    <a href=""
                       class="text-blue-600 mr-2">Edit</a>

                    <form action=""
                          method="POST"
                          class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600"
                                onclick="return confirm('Delete role?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
