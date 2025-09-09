<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gender;
use App\Models\Religion;
use App\Models\Caste;
use App\Models\Occupation;

class LegalAidController extends Controller
{
    public function index()
    {
        $genders = Gender::all();
        $religions = Religion::all();
        $castes = Caste::all();
        $occupations = Occupation::all();

        return view('homepage.legalaid', compact('genders', 'religions', 'castes', 'occupations'));
    }
}
