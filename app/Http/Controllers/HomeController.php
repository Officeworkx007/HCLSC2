<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
     public function legal()
    {
        return view('homepage.legalaid');
    }
}
