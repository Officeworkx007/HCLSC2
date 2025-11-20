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
        // Fetch all cause lists, newest scheduled mediation date first, with uploader info
        $causeLists = MediationCauseList::with('uploader')
            // 👇 Change the sorting column to the date the mediation is scheduled for
            ->orderByDesc('to_be_held_on')
            // 👇 Add a secondary sort by upload time, in case two lists have the same held-on date
            ->orderByDesc('created_at')
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

    // --- START OF CORRECTED STORE METHOD ---
    /**
     * Store a newly created cause list in storage.
     */
    public function store(Request $request)
    {
        // Validation: Removed the date chronology rule to allow historical uploads
        $request->validate([
            'cause_list_date' => 'required|date',

            // --- KEY CHANGE: Removed after_or_equal:cause_list_date ---
            'to_be_held_on' => 'required|date',

            // 10MB limit (10 * 1024 = 10240 KB)
            'file' => 'required|mimes:pdf|max:10240',
            'description' => 'nullable|string',
        ]);

        // File Upload: Check if present and store
        if (!$request->hasFile('file')) {
            // This fallback should only trigger if PHP server configuration failed the upload
            return back()->withInput()->withErrors(['file' => 'File upload failed (PHP server limits?).']);
        }

        $originalName = $request->file('file')->getClientOriginalName();
        $filePath = $request->file('file')->storeAs('causelists', $originalName, 'public');

        // Determine initial status dynamically (Logic is correct and independent of cause_list_date)
        $heldDate = \Carbon\Carbon::parse($request->to_be_held_on);
        $now = now(); // Uses current time (2025-11-10 3:45 PM IST)

        if ($now->lt($heldDate->copy()->setTime(11, 0, 0))) {
            // Held date is in the future, or today but before 11 AM
            $status = 'upcoming';
        } elseif ($now->between($heldDate->copy()->setTime(11, 0, 0), $heldDate->copy()->setTime(18, 0, 0))) {
            // Held date is today, between 11 AM and 6 PM
            $status = 'ongoing';
        } else {
            // Held date is fully in the past (e.g., 2025-10-27) or today after 6 PM
            $status = 'completed';
        }

        // Database Storage
        \App\Models\MediationCauseList::create([
            'cause_list_date' => $request->cause_list_date,
            'to_be_held_on' => $request->to_be_held_on,
            'description' => $request->description,
            'file_path' => $filePath,
            'status' => $status,
            'uploaded_by' => \Illuminate\Support\Facades\Auth::id(),
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

            // --- KEY CHANGE: Removed after_or_equal:cause_list_date ---
            // This allows updating historical records where the Held Date is before the Order Date.
            'to_be_held_on' => 'required|date',

            // Retained 10MB limit consistency
            'file' => 'nullable|mimes:pdf|max:10240',
            'description' => 'nullable|string',
        ]);

        $causeList = MediationCauseList::findOrFail($id);

        // Dynamic Status Calculation (Logic is correct and independent of cause_list_date)
        $heldDate = \Carbon\Carbon::parse($request->to_be_held_on);
        $now = now();

        if ($now->lt($heldDate->copy()->setTime(11, 0, 0))) {
            $status = 'upcoming';
        } elseif ($now->between($heldDate->copy()->setTime(11, 0, 0), $heldDate->copy()->setTime(18, 0, 0))) {
            $status = 'ongoing';
        } else {
            // Correctly sets status to 'completed' for past events
            $status = 'completed';
        }

        $filePath = $causeList->file_path;

        // File Handling
        if ($request->hasFile('file')) {
            // Delete old file if it exists
            if ($filePath && \Storage::disk('public')->exists($filePath)) {
                \Storage::disk('public')->delete($filePath);
            }
            // Upload new file
            $originalName = $request->file('file')->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('causelists', $originalName, 'public');
        }

        // Database Update
        $causeList->update([
            'cause_list_date' => $request->cause_list_date,
            'to_be_held_on' => $request->to_be_held_on,
            'description' => $request->description,
            'file_path' => $filePath,
            'status' => $status,
            // No need to update 'uploaded_by' here as it's typically set on create only
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

    public function viewPdf($filename)
    {
        // Generate the URL pointing to the NEW route that streams the content
        $fileUrl = route('admin.mediations.servePdfContent', ['filename' => $filename]);

        return view('admin.mediations.pdf-view', compact('fileUrl'));
    }

    /**
     * Serves the PDF file content directly to the browser for viewing.
     */
    public function servePdfContent($filename)
    {
        $filePath = 'causelists/' . $filename;

        if (!\Storage::disk('public')->exists($filePath)) {
            abort(404, 'PDF file not found.');
        }

        // Read the file content as raw bytes
        $pdfContent = \Storage::disk('public')->get($filePath);
        $fileNameForDisplay = pathinfo($filename, PATHINFO_BASENAME);

        // This is the CRITICAL part:
        // We explicitly set 'inline' and the Content-Type header.
        return response($pdfContent, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Length', strlen($pdfContent))
            ->header('Content-Disposition', 'inline; filename="' . $fileNameForDisplay . '"')
            // Add CORS headers, as the Adobe API is making a cross-origin request to this URL
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With');
    }
}
