<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MediationCauseList;

class MediationController extends Controller
{
    public function index()
    {
        // Fetch all cause lists, newest first, with uploader info
        $causeLists = MediationCauseList::with('uploader')
            ->orderByDesc('cause_list_date')
            ->get();

        // Return the index view with the cause lists
        return view('admin.mediations.index', compact('causeLists'));
    }

    /**
     * Show the form for creating a new cause list.
     */
    public function create()
    {
        return view('admin.mediations.create');
    }

    /**
     * Store a newly created cause list in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cause_list_date' => 'required|date',
            'file' => 'required|mimes:pdf|max:2048',
            'status' => 'required|in:upcoming,completed',
            'description' => 'nullable|string',
        ]);

        $filePath = $request->file('file')->store('causelists', 'public');

        MediationCauseList::create([
            'cause_list_date' => $request->cause_list_date,
            'description' => $request->description,
            'file_path' => $filePath,
            'status' => $request->status,
            'uploaded_by' => Auth::id(),
        ]);

        return redirect()->route('admin.mediations.index')
            ->with('success', 'Cause list uploaded successfully!');
    }
}
