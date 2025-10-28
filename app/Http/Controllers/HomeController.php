<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\PanelLawyer;
use App\Models\MediationCauseList;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

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

    public function mediations()
    {
        $causeLists = \App\Models\MediationCauseList::orderByDesc('to_be_held_on')->paginate(10);
        return view('homepage.mediation', compact('causeLists'));
    }

    public function viewPDF($id)
    {
        $file = \App\Models\MediationCauseList::findOrFail($id);

        if (!$file->file_path || !\Storage::disk('public')->exists($file->file_path)) {
            abort(404, 'File not found.');
        }

        // Return the file as a public URL
        $url = asset('storage/' . $file->file_path);
        return redirect($url); // just redirects browser to open directly
    }
}
