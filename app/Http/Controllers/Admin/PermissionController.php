<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    /**
     * Display a listing of the permissions.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all permissions to display in the table
        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new permission.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created permission in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 1. Validation: Ensure the name is required, a string, max 255 chars, and unique in the permissions table
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        try {
            // 2. Normalize and Create Permission
            // Use Str::slug to ensure the permission name is lowercase and hyphenated/underscored if needed (Spatie best practice)
            // However, since we guide the user to use simple phrases like 'view users', we'll just use lowercasing here.
            $permissionName = Str::lower(trim($request->name));

            Permission::create(['name' => $permissionName]);

            return redirect()->route('admin.permissions.index')->with('success', "Permission '{$permissionName}' created successfully.");

        } catch (\Exception $e) {
            // 3. Handle potential database or other errors
            return back()->withInput()->withErrors(['error' => 'Could not create permission. Please try again.']);
        }
    }
}
