<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Applicant;
use App\Models\Gender;
use App\Models\Religion;
use App\Models\Caste;
use App\Models\EligibilityCategory;
use App\Models\Occupation;
use App\Models\Income;
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
        $incomes = Income::all();
        $eligibilities = EligibilityCategory::all();
        $documents = UploadDocument::all();

        return view('homepage.legalaid', compact('genders', 'religions', 'castes', 'occupations', 'incomes', 'eligibilities', 'documents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'upload_documents.*' => 'nullable|integer|exists:upload_documents,id',
            'document_files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $applicant = new Applicant();
        $applicant->name = $request->name;
        $applicant->father_name = $request->father_name;
        $applicant->mother_name = $request->mother_name;
        $applicant->spouse_name = $request->spouse_name;
        $applicant->gender_id = $request->gender;
        $applicant->number = $request->number;
        $applicant->email = $request->email;
        $applicant->religion_id = $request->religion;
        $applicant->caste_id = $request->caste;
        $applicant->certificate_no = $request->certificate_no;
        $applicant->occupation_id = $request->occupation;
        $applicant->employment_details = $request->employment_details;
        $applicant->income_id = $request->income;
        $applicant->eligibility_category_id = $request->eligibility_category;

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
        return redirect()->route('homepage.track', ['token' => $applicant->token_number])
            ->with('success', 'Application submitted successfully!')
            ->with('token_number', $applicant->token_number);
    }

    public function pageView()
    {
        $applicants = Applicant::with([
            'gender',
            'religion',
            'caste',
            'occupation',
            'income',
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
            'income',
            'eligibilityCategory',
            'documents.uploadDocument'
        ])->findOrFail($id);

        $panelLawyers = PanelLawyer::all(); // fetched from your panel lawyer table
        return view('admin.legal_aid.show', compact('applicant', 'panelLawyers'));
    }

    // Show track page with optional flash messages
    public function trackPage(Request $request)
    {
        $form = null;
        $error = null;

        if ($request->has('token') && $request->has('name')) {
            $form = Applicant::where('token_number', $request->token)
                ->where('name', $request->name)
                ->first();
            if (!$form) {
                $error = 'Invalid Token Number or Name!';
            }
        }

        return view('homepage.track', compact('form', 'error'));
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
            'docs.*' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048',
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
}
