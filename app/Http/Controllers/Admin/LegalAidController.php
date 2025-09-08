<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gender;

class LegalAidController extends Controller
{
    public function index()
    {
        $genders = Gender::all();

        return view('homepage.legalaid', compact('genders'));
    }
}
