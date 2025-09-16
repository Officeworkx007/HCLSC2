<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PanelLawyer;
use Illuminate\Http\Request;

class PanelLawyerController extends Controller
{
    /**
     * Display a listing of panel lawyers.
     */
    public function index()
    {
        // Fetch all lawyers (you can paginate if list grows big)
        $panelLawyers = PanelLawyer::latest()->paginate(10);

        return view('admin.panel_lawyers.index', compact('panelLawyers'));
    }

    /**
     * Show the form for creating a new lawyer.
     */
    public function create()
    {
        return view('admin.panel_lawyers.create');
    }

    /**
     * Store a newly created lawyer in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'   => 'required|string|max:100',
            'last_name'    => 'required|string|max:100',
            'email'        => 'nullable|email|unique:panel_lawyers,email',
            'phone_number' => 'nullable|string|max:20',
            'address'      => 'nullable|string|max:500',
            'city'         => 'nullable|string|max:50',
            'pin_code'     => 'nullable|string|max:20',
        ]);

        PanelLawyer::create($data);

        return redirect()
            ->route('admin.panel_lawyers.index')
            ->with('success', 'Panel Lawyer added successfully!');
    }

    public function destroy($id)
    {
        $lawyer = PanelLawyer::findOrFail($id);
        $lawyer->delete();

        return redirect()
            ->route('admin.panel_lawyers.index')
            ->with('success', 'Panel Lawyer deleted successfully!');
    }
}
