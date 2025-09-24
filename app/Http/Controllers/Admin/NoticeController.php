<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::orderBy('id', 'asc')->paginate(10);
        return view('admin.notices.index', compact('notices'));
    }

    public function create()
    {
        return view('admin.notices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'order_no' => 'required|string|max:50',
            'notice_date' => 'required|date',
            'pdf' => 'nullable|mimes:pdf|max:10120', // allow only PDF, max 10MB
        ]);

        $data = $request->all();
        $data['status'] = 1; // always active on creation

        if ($request->hasFile('pdf')) {
            $fileName = time() . '_' . $request->file('pdf')->getClientOriginalName();
            $path = $request->file('pdf')->storeAs('notices', $fileName, 'public');
            $data['pdf_path'] = $path;
        }

        Notice::create($data);

        return redirect()->route('admin.notices.index')->with('success', 'Your Notice has been created successfully');
    }

    public function edit(Notice $notice)
    {
        return view('admin.notices.edit', compact('notice'));
    }

    public function update(Request $request, Notice $notice)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'order_no' => 'nullable|string|max:50',
            'notice_date' => 'required|date',
            'status' => 'required|boolean',
            'pdf' => 'nullable|mimes:pdf|max:5120', // allow only PDF, max 5MB
        ]);

        $data = $request->all();

        if ($request->hasFile('pdf')) {
            $fileName = time() . '_' . $request->file('pdf')->getClientOriginalName();
            $path = $request->file('pdf')->storeAs('notices', $fileName, 'public');
            $data['pdf_path'] = $path;
        }

        $notice->update($data);

        return redirect()->route('admin.notices.index')->with('success', 'Notice updated successfully.');
    }


    /**
     * Delete a notice.
     */
    public function destroy(Notice $notice)
    {
        $notice->delete();
        return redirect()->route('admin.notices.index')->with('success', 'Notice deleted successfully.');
    }

    /**
     * Toggle notice status (Active/Inactive).
     */
    public function toggleStatus(Notice $notice)
    {
        $notice->status = !$notice->status;
        $notice->save();

        return redirect()->route('admin.notices.index')->with('success', 'Notice status updated.');
    }
}
