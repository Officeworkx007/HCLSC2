<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            'to_be_held_on' => 'required|date|after_or_equal:cause_list_date',
            'file' => 'required|mimes:pdf|max:2048',
            'description' => 'nullable|string',
        ]);

        // Store uploaded file in 'storage/app/public/causelists' with original file name
        $originalName = $request->file('file')->getClientOriginalName();
        $filePath = $request->file('file')->storeAs('causelists', $originalName, 'public');

        // Determine initial status dynamically
        $heldDate = \Carbon\Carbon::parse($request->to_be_held_on);
        $now = now();

        if ($now->lt($heldDate->copy()->setTime(11, 0, 0))) {
            $status = 'upcoming';
        } elseif ($now->between($heldDate->copy()->setTime(11, 0, 0), $heldDate->copy()->setTime(18, 0, 0))) {
            $status = 'ongoing';
        } else {
            $status = 'completed';
        }

        MediationCauseList::create([
            'cause_list_date' => $request->cause_list_date,
            'to_be_held_on' => $request->to_be_held_on,
            'description' => $request->description,
            'file_path' => $filePath,
            'status' => $status,
            'uploaded_by' => Auth::id(),
        ]);

        return redirect()->route('admin.mediations.index')
            ->with('success', 'Cause list uploaded successfully!');
    }

    public function edit($id)
    {
        $mediation = MediationCauseList::findOrFail($id);
        return view('admin.mediations.edit', compact('mediation'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cause_list_date' => 'required|date',
            'to_be_held_on' => 'required|date|after_or_equal:cause_list_date',
            'file' => 'nullable|mimes:pdf|max:2048',
            'description' => 'nullable|string',
        ]);

        $causeList = MediationCauseList::findOrFail($id);

        $heldDate = \Carbon\Carbon::parse($request->to_be_held_on);
        $now = now();

        if ($now->lt($heldDate->copy()->setTime(11, 0, 0))) {
            $status = 'upcoming';
        } elseif ($now->between($heldDate->copy()->setTime(11, 0, 0), $heldDate->copy()->setTime(18, 0, 0))) {
            $status = 'ongoing';
        } else {
            $status = 'completed';
        }

        $filePath = $causeList->file_path;

        if ($request->hasFile('file')) {
            if ($filePath && \Storage::disk('public')->exists($filePath)) {
                \Storage::disk('public')->delete($filePath);
            }
            $originalName = $request->file('file')->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('causelists', $originalName, 'public');
        }

        $causeList->update([
            'cause_list_date' => $request->cause_list_date,
            'to_be_held_on' => $request->to_be_held_on,
            'description' => $request->description,
            'file_path' => $filePath,
            'status' => $status,
        ]);

        return redirect()->route('admin.mediations.index')
            ->with('success', 'Cause list updated successfully!');
    }

    public function destroy($id)
    {
        $causeList = MediationCauseList::findOrFail($id);

        // Delete file if it exists
        if ($causeList->file_path && \Storage::disk('public')->exists($causeList->file_path)) {
            \Storage::disk('public')->delete($causeList->file_path);
        }

        $causeList->delete();

        return redirect()->route('admin.mediations.index')
            ->with('success', 'Cause list deleted successfully!');
    }
}
