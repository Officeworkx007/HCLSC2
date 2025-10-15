<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\PanelLawyer;

class HomeController extends Controller
{
    public function home()
    {
        $notices = Notice::where('status', 1)
            ->orderBy('notice_date', 'desc')
            ->get();
        return view('homepage.home', compact('notices')); // path to your landing page blade
    }

    public function circular()
    {
        $notices = Notice::where('status', 1)
            ->orderBy('id', 'asc')   // earliest added first
            ->get();
        return view('homepage.notice', compact('notices'));
    }

    public function contact()
    {
        return view('homepage.contactus');
    }

    public function hclscintro()
    {
        return view('homepage.intro');
    }

    public function lawyers()
    {
        $panelLawyers = PanelLawyer::paginate(10);
        return view('homepage.lawyers', compact('panelLawyers'));
    }
}
