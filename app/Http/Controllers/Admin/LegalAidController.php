<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gender;
use App\Models\Religion;
use App\Models\Caste;
use App\Models\EligibilityCategory;
use App\Models\Occupation;
use App\Models\Income;

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

        return view('homepage.legalaid', compact('genders', 'religions', 'castes', 'occupations', 'incomes', 'eligibilities'));
    }
}
