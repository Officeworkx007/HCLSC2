<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;

class HomeController extends Controller
{
    public function home()
    {
        return view('homepage.home'); // path to your landing page blade
    }

    public function circular()
    {
        $notices = Notice::where('status', 1)
            ->orderBy('id', 'asc')   // earliest added first
            ->get();
        return view('homepage.notice', compact('notices'));
    }
}
