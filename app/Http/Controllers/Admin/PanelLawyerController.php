<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PanelLawyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PanelLawyerController extends Controller
{
    /**
     * Display a listing of panel lawyers.
     */
    public function index()
    {
        // Fetch all lawyers (you can paginate if list grows big)
        $panelLawyers = PanelLawyer::orderBy('created_at', 'asc')->get();

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
        // 1. Validation and 10MB Limit Enforcement
        $validatedData = $request->validate([
            'first_name'   => 'required|string|max:100',
            'last_name'    => 'required|string|max:100',
            'email'        => 'nullable|email|unique:panel_lawyers,email',
            'phone_number' => 'nullable|string|max:20',
            'address'      => 'nullable|string|max:500',
            'city'         => 'nullable|string|max:50',
            'pin_code'     => 'nullable|string|max:20',
            'designation'  => 'nullable|string|max:50',
            'enrolment_no' => 'nullable|string|max:100',    

            // 📸 Photo Validation (max:10240 = 10MB)
            'photo'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $validatedData['photo'] = null; // Initialize photo path as null

        // 2. Handle File Upload
        if ($request->hasFile('photo')) {
            // Store the file and get the path.
            // Files will be stored in storage/app/public/lawyer_photos/
            $path = $request->file('photo')->store('lawyer_photos', 'public');

            // Save the public path to the data array
            $validatedData['photo'] = $path;
        }

        // 3. Create the Database Record
        PanelLawyer::create($validatedData);

        return redirect()
            ->route('admin.panel_lawyers.index')
            ->with('success', 'Panel Lawyer added successfully!');
    }

    /**
     * Remove the specified panel lawyer from storage.
     */
    public function destroy($id)
    {
        $lawyer = PanelLawyer::findOrFail($id);

        // 🗑️ Delete the photo file from storage if it exists
        if ($lawyer->photo) {
            Storage::disk('public')->delete($lawyer->photo);
        }

        $lawyer->delete();

        return redirect()
            ->route('admin.panel_lawyers.index')
            ->with('success', 'Panel Lawyer deleted successfully!');
    }

    public function edit($id)
    {
        // 1. Find the lawyer or fail
        $lawyer = PanelLawyer::findOrFail($id);

        // 2. Pass the lawyer data to the edit view
        return view('admin.panel_lawyers.edit', compact('lawyer'));
    }

    /**
     * Update the specified panel lawyer in storage.
     */
    public function update(Request $request, $id)
    {
        $lawyer = PanelLawyer::findOrFail($id);

        // 1. Validation (Ignore current lawyer's email for unique check)
        $validatedData = $request->validate([
            'first_name'   => 'required|string|max:100',
            'last_name'    => 'required|string|max:100',
            // 💡 FIX: Ignore the current lawyer's ID for the unique check
            'email'        => 'nullable|email|unique:panel_lawyers,email,' . $lawyer->id,
            'phone_number' => 'nullable|string|max:20',
            'address'      => 'nullable|string|max:500',
            'city'         => 'nullable|string|max:50',
            'pin_code'     => 'nullable|string|max:20',
            'designation'  => 'nullable|string|max:50',
            'enrolment_no' => 'nullable|string|max:100',
            
            // Photo is nullable, max 10MB
            'photo'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        // Initialize the photo path from the existing record
        $validatedData['photo'] = $lawyer->photo;

        // 2. Handle File Update
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($lawyer->photo) {
                Storage::disk('public')->delete($lawyer->photo);
            }
            // Store the new file and update the path
            $validatedData['photo'] = $request->file('photo')->store('lawyer_photos', 'public');
        }

        // 3. Update the Database Record
        $lawyer->update($validatedData);

        // This uses the 'success' flash message for the auto-hiding alert
        return redirect()
            ->route('admin.panel_lawyers.index')
            ->with('success', 'Panel Lawyer updated successfully!');
    }

}
