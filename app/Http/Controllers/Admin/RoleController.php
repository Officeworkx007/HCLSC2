<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $allPermissions = Permission::all();

        return view('admin.roles.index', compact('roles', 'allPermissions'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
        ]);

        $roleName = Str::lower(trim($request->name));

        $role = Role::create(['name' => $roleName]);

        if ($request->filled('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role created successfully.');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view(
            'admin.roles.edit',
            compact('role', 'permissions', 'rolePermissions')
        );
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
        ]);

        $role->update([
            'name' => Str::lower(trim($request->name)),
        ]);

        $role->syncPermissions($request->permissions ?? []);

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        $role->syncPermissions([]);
        $role->delete();

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}
