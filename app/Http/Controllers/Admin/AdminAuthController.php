<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class AdminAuthController extends Controller
{
    private $adminkey;

    public function __costruct()
    {
        //fetching admin key from config (safe for config:cache)
        $this->adminkey = config('app.admin_access_key');
    }

    public function CheckAdminKey(Request $request)
    {
        if ($request->query('key') !== $this->adminkey) {
            return redirect('/');
        }
    }

    public function registerForm(Request $request)
    {
        $this->CheckAdminKey($request);
        return view('admin.auth.register');
    }

    public function register(Request $request)
    {
        $this->CheckAdminKey($request);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' =>  'required|email|unique:users',
            'password'  =>  'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name'  =>  $request->name,
            'email' =>  $request->email,
            'password'  => Hash::make($request->password),
        ]);

        // Ensure the 'admin' role exists before assigning
        $adminRole = \Spatie\Permission\Models\Role::findOrCreate('admin');

        // 🔹 Sync all existing permissions to the admin role
        $permissions = \Spatie\Permission\Models\Permission::all();
        $adminRole->syncPermissions($permissions);

        // Assign the role
        $user->assignRole('admin');

        Auth::login($user);

        return redirect()->route('admin.dashboard')->with('Success', 'Admin registered successfully');
    }

    public function loginForm(Request $request)
    {
        $this->CheckAdminKey($request);
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            }

            Auth::logout();
            return redirect()->route('admin.login')->withErrors(['error' => 'Access denied.']);
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }
}
