<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Applicant;
use App\Models\Gender;
use App\Models\Religion;
use App\Models\Caste;
use App\Models\EligibilityCategory;
use App\Models\Occupation;
use App\Models\UploadDocument;
use App\Models\PanelLawyer;
use App\Models\Rejection;
use App\Models\Doc;


class LegalAidController extends Controller
{
    public function index()
    {
        $genders = Gender::all();
        $religions = Religion::all();
        $castes = Caste::all();
        $occupations = Occupation::all();
        $eligibilities = EligibilityCategory::all();
        $documents = UploadDocument::all();

        return view('homepage.legalaid', compact('genders', 'religions', 'castes', 'occupations', 'eligibilities', 'documents'));
    }

    public function store(Request $request)
    {
        // Define the ID for the 'General' category from your seeder list (index 7, so ID 8)
        $generalEligibilityId = 8;

        // 🚨 START: UPDATED VALIDATION RULES
        $rules = [
            'name' => 'required|string|max:255',
            'marital_status' => 'required|boolean',
            'spouse_name' => 'nullable|string|max:255',
            'gender' => 'required|integer|exists:genders,id',
            'number' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'religion' => 'required|integer|exists:religions,id',
            'caste' => 'required|integer|exists:castes,id',
            'occupation' => 'required|integer|exists:occupations,id',
            'eligibility_category' => 'required|integer|exists:eligibility_category,id',

            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'certificate_no' => 'nullable|string|max:50',
            'employment_details' => 'nullable|string|max:255',

            'photo' => 'nullable|image|max:10048',
            'upload_documents.*' => 'nullable|integer|exists:upload_documents,id',
            'document_files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',

            // ⭐ NEW CONDITIONAL VALIDATION RULE ⭐
            'annual_income_amount' => [
                'nullable',
                'integer',
                'min:0',
                // This rule makes the field REQUIRED if the selected eligibility_category is the 'General' ID (8)
                'required_if:eligibility_category,' . $generalEligibilityId,
            ],
        ];

        $request->validate($rules);
        // 🚨 END: UPDATED VALIDATION RULES

        $applicant = new Applicant();
        $applicant->name = $request->name;
        $applicant->father_name = $request->father_name;
        $applicant->mother_name = $request->mother_name;

        $applicant->marital_status = $request->marital_status;
        $applicant->spouse_name = $request->spouse_name;
        $applicant->gender_id = $request->gender;
        $applicant->number = $request->number;
        $applicant->email = $request->email;
        $applicant->religion_id = $request->religion;
        $applicant->caste_id = $request->caste;
        $applicant->certificate_no = $request->certificate_no;
        $applicant->occupation_id = $request->occupation;
        $applicant->employment_details = $request->employment_details;
        $applicant->eligibility_category_id = $request->eligibility_category;

        // ⭐ NEW: SAVE THE ANNUAL INCOME AMOUNT ⭐
        $applicant->annual_income_amount = $request->annual_income_amount;
        // ✅ Save photo if uploaded
        if ($request->hasFile('photo')) {
            $applicant->photo = $request->file('photo')->store('applicants/photos', 'public');
        }

        // ✅ Save the applicant first (needed for ID-based token)
        $applicant->save();

        // ✅ Generate a structured token number: HCLSC2025-00001
        $year = now()->year;
        $lastApplicant = Applicant::whereYear('created_at', $year)
            ->whereNotNull('token_number')
            ->orderBy('id', 'desc')
            ->first();

        // Extract last number if exists, else start at 1
        if ($lastApplicant && preg_match('/HCLSC' . $year . '-(\d+)/', $lastApplicant->token_number, $matches)) {
            $nextNumber = intval($matches[1]) + 1;
        } else {
            $nextNumber = 1;
        }

        $token = 'HCLSC' . $year . '-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        // ✅ Update applicant with the token number
        $applicant->update(['token_number' => $token]);

        // ✅ Handle document uploads
        if ($request->has('upload_documents')) {
            foreach ($request->upload_documents as $index => $documentId) {
                if ($documentId && isset($request->document_files[$index])) {
                    $filePath = $request->file('document_files')[$index]->store('applicants/documents', 'public');

                    $applicant->documents()->create([
                        'upload_document_id' => $documentId,
                        'file_path' => $filePath,
                    ]);
                }
            }
        }

        // ✅ Redirect to tracking page with token number
        return redirect()->route('homepage.track')
            ->with('success', 'Application submitted successfully! Please use your Token Number and Name to check the status.')
            ->with('token_number', $applicant->token_number);
    }

    public function pageView()
    {
        $applicants = Applicant::with([
            'gender',
            'religion',
            'caste',
            'occupation',
            'eligibilityCategory',
            'documents.uploadDocument',
            'rejection'
        ])->latest()->get();

        return view('admin.legal_aid.index', compact('applicants'));
    }

    public function show($id)
    {
        $applicant = Applicant::with([
            'gender',
            'religion',
            'caste',
            'occupation',
            'eligibilityCategory',
            'documents.uploadDocument'
        ])->findOrFail($id);

        $panelLawyers = PanelLawyer::all(); // fetched from your panel lawyer table
        return view('admin.legal_aid.show', compact('applicant', 'panelLawyers'));
    }

    public function showTrackForm(Request $request)
    {
        // 1. Retrieve the flashed data (form results and error message)
        $form = session('form', null);
        $error = session('error', null);

        // This function will be called on the initial GET request to /track
        // It renders the view, either empty or with the one-time flashed results.
        return view('homepage.track', compact('form', 'error'));
    }

    // 2. Renamed function to process the form submission (POST)
    public function trackApplication(Request $request)
    {
        // Validation handles error redirect automatically, flashing input data
        $request->validate([
            'token' => 'required|string|max:50',
            'name' => 'required|string|max:255',
        ]);

        $form = Applicant::where('token_number', $request->token)
            ->where('name', $request->name)
            ->with(['rejection', 'panelLawyer', 'caseDocs'])
            ->first();

        $flashData = [];

        if ($form) {
            // Flash the successful result object to the session
            $flashData['form'] = $form;
        } else {
            // Flash the error message to the session
            $flashData['error'] = 'Invalid Token Number or Name!';
        }

        // Flash the input data so the fields remain filled on the GET page
        $flashData['token_input'] = $request->token;
        $flashData['name_input'] = $request->name;

        // **CRITICAL CHANGE:** Redirect back to the GET route and flash data.
        // This stops the browser from holding the POST data on refresh.
        return redirect()->route('homepage.track')->with($flashData);
    }

    public function assignLawyer(Request $request, $id)
    {
        $request->validate([
            'panel_lawyer_id' => 'nullable|exists:panel_lawyers,id',
        ]);

        $applicant = Applicant::findOrFail($id);

        if ($request->panel_lawyer_id) {
            $applicant->panel_lawyer_id = $request->panel_lawyer_id;
            $applicant->status = 'Assigned';
        } else {
            // ✅ “None” selected → revert to pending
            $applicant->panel_lawyer_id = null;
            $applicant->status = 'Pending';
        }

        $applicant->save();

        return back()->with('success', $request->panel_lawyer_id
            ? 'Panel lawyer assigned successfully.'
            : 'Case reverted to Pending.');
    }

    public function rejectApplicant(Request $request, $id)
    {
        $request->validate([
            'remark' => 'required|string|max:1000',
        ]);

        $applicant = Applicant::findOrFail($id);

        // Create or update rejection record
        $rejection = Rejection::updateOrCreate(
            ['applicant_id' => $applicant->id],
            [
                'remark' => $request->remark,
                'is_rejected' => true,
            ]
        );

        // Update applicant status (consistent capitalization)
        $applicant->update([
            'status' => 'Rejected',
            'panel_lawyer_id' => null, // remove lawyer if previously assigned
        ]);

        return back()->with('success', 'Applicant has been rejected successfully.');
    }

    public function revertApplicant($id)
    {
        $applicant = Applicant::findOrFail($id);

        // ✅ Update applicant status back to Pending
        $applicant->update([
            'status' => 'Pending',
            'panel_lawyer_id' => null,
        ]);

        // ✅ Clear rejection remark and mark as not rejected
        if ($applicant->rejection) {
            $applicant->rejection->update([
                'is_rejected' => false,
                'remark' => null, // 🧹 clears the previous rejection note
            ]);
        }

        return back()->with('success', 'Applicant status reverted to Pending and remarks cleared successfully.');
    }

    public function storeOrderAndDocs(Request $request, $id)
    {
        // ✅ Validation
        $request->validate([
            'order_no' => 'required|string|max:255',
            'docs' => 'required|array',
            'docs.*' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
        ]);

        // ✅ Fetch applicant
        $applicant = Applicant::findOrFail($id);

        // ✅ Only allow upload if lawyer assigned
        if ($applicant->status !== 'Assigned') {
            return back()->with('error', 'Order & documents can only be uploaded after lawyer is assigned.');
        }

        // ✅ Handle each uploaded file correctly
        $files = $request->file('docs'); // match input name "docs[]"
        if ($files && count($files) > 0) {
            foreach ($files as $file) {
                $path = $file->store('order_docs', 'public');

                // ✅ Use the relationship to auto-fill applicant_id
                $applicant->caseDocs()->create([
                    'order_no'      => $request->order_no,
                    'file_path'     => $path,
                    'original_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        return back()->with('success', 'Order and documents uploaded successfully.');
    }

    // 🌟 START: ADDED DELETE FUNCTION 🌟
    public function deleteCaseDoc($docId)
    {
        $doc = Doc::findOrFail($docId);

        // Delete the file from storage
        if (Storage::disk('public')->exists($doc->file_path)) {
            Storage::disk('public')->delete($doc->file_path);
        }

        // Delete the database record
        $doc->delete();

        return back()->with('success', 'Case document/order deleted successfully.');
    }
    // 🌟 END: ADDED DELETE FUNCTION 🌟

    public function destroy($id)
    {
        $applicant = Applicant::with(['documents', 'rejection', 'caseDocs'])->findOrFail($id);

        // 1️⃣ Delete uploaded applicant photo if exists
        if ($applicant->photo && Storage::disk('public')->exists($applicant->photo)) {
            Storage::disk('public')->delete($applicant->photo);
        }

        // 2️⃣ Delete related uploaded documents
        foreach ($applicant->documents as $doc) {
            if ($doc->file_path && Storage::disk('public')->exists($doc->file_path)) {
                Storage::disk('public')->delete($doc->file_path);
            }
            $doc->delete();
        }

        // 3️⃣ Delete related case documents/orders
        foreach ($applicant->caseDocs as $caseDoc) {
            if ($caseDoc->file_path && Storage::disk('public')->exists($caseDoc->file_path)) {
                Storage::disk('public')->delete($caseDoc->file_path);
            }
            $caseDoc->delete();
        }

        // 4️⃣ Delete rejection record if exists
        if ($applicant->rejection) {
            $applicant->rejection->delete();
        }

        // 5️⃣ Finally, delete the applicant
        $applicant->delete();

        return redirect()->route('admin.legal_aid.index')->with('success', 'Applicant and all related records have been deleted successfully.');
    }
}
