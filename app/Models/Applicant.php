<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Caste;
use App\Models\Doc;
use App\Models\Gender;
use App\Models\Income;
use App\Models\Religion;
use App\Models\Rejection;
use App\Models\Occupation;
use App\Models\PanelLawyer;
use App\Models\ApplicantDocument;
use App\Models\EligibilityCategory;

class Applicant extends Model
{
    protected $fillable = [
        'name',
        'father_name',
        'mother_name',
        'marital_status',
        'spouse_name',
        'gender_id',
        'number',
        'token_number',
        'email',
        'religion_id',
        'caste_id',
        'certificate_no',
        'occupation_id',
        'employment',
        'income_id',
        'eligibility_category_id',
        'photo',
        'panel_lawyer_id', // ✅ allow mass assignment for assigned lawyer
        'status',
        'annual_income_amount',
    ];

    protected $casts = [
        'marital_status' => 'boolean',
    ];

    /**
     * Relationships
     */
    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }

    public function caste()
    {
        return $this->belongsTo(Caste::class, 'caste_id');
    }

    public function occupation()
    {
        return $this->belongsTo(Occupation::class, 'occupation_id');
    }

    public function income()
    {
        return $this->belongsTo(Income::class, 'income_id');
    }

    public function eligibilityCategory()
    {
        return $this->belongsTo(EligibilityCategory::class, 'eligibility_category_id');
    }

    public function documents()
    {
        return $this->hasMany(ApplicantDocument::class);
    }

    /**
     * Documents uploaded after lawyer assignment (orders, case files)
     */
    public function caseDocs()
    {
        return $this->hasMany(Doc::class, 'applicant_id');
    }

    // ✅ New Relationship: Applicant → Panel Lawyer
    public function panelLawyer()
    {
        return $this->belongsTo(PanelLawyer::class, 'panel_lawyer_id');
    }

    public function rejection()
    {
        return $this->hasOne(Rejection::class);
    }
}
