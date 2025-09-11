<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\Gender;
use App\Models\Religion;
use App\Models\Caste;
use App\Models\EligibilityCategory;
use App\Models\Occupation;
use App\Models\Income;
use App\Models\UploadDocument;

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
            'upload_documents.*' => 'nullable|integer|exists:upload_documents,id', // <-- fixed table name
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

        if ($request->hasFile('photo')) {
            $applicant->photo = $request->file('photo')->store('applicants/photos', 'public');
        }

        $applicant->save();

        // Handle document uploads
        if ($request->has('upload_documents')) {
            foreach ($request->upload_documents as $index => $documentId) {
                if ($documentId && isset($request->document_files[$index])) {
                    $filePath = $request->file('document_files')[$index]->store('applicants/documents', 'public');

                    $applicant->documents()->create([
                        'upload_document_id' => $documentId, // <-- use this exact column name
                        'file_path' => $filePath,
                    ]);
                }
            }
        }

        return redirect()->route('homepage.legalaid')->with('success', 'Applicant created successfully!');
    }
}
