<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\PanelLawyer;
use App\Models\CalendarYear;
use Carbon\Carbon;
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
        // 🛑 FIX: Fetch all lawyers, not just 10. DataTables will handle the visual pagination.
        $panelLawyers = PanelLawyer::all();
        return view('homepage.lawyers', compact('panelLawyers'));
    }

    public function mediations()
    {
        $causeLists = \App\Models\MediationCauseList::orderByDesc('to_be_held_on')->paginate(10);
        return view('homepage.mediation', compact('causeLists'));
    }

    public function viewPdf($filename)
    {
        // Decode URL-encoded filename (handles spaces, dots, etc.)
        $decodedFilename = urldecode($filename);

        // Build the public URL (from /public/storage symlink)
        $fileUrl = asset('storage/causelists/' . $decodedFilename);

        // Check if the actual file exists in storage
        $filePath = storage_path('app/public/causelists/' . $decodedFilename);
        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        // Redirect to PDF.js viewer with ?file= parameter
        return redirect("/pdfjs/web/viewer.html?file=" . urlencode($fileUrl));
    }

    public function images()
    {
        // Fetch all gallery albums with number of photos in each
        $albums = \App\Models\GalleryAlbum::withCount('photos')
            ->orderByDesc('id')
            ->get();

        return view('homepage.gallery', compact('albums'));
    }

    public function publicCalendarEvents()
    {
        $events = CalendarYear::orderBy('event_date')
            ->get()
            ->map(function ($event) {
                return [
                    'id'    => $event->id,
                    'title' => $event->title,
                    'start' => $event->event_date->toDateString(),
                    'allDay' => true,
                    'extendedProps' => [
                        'event_type'  => $event->event_type,
                        'description' => $event->description,
                    ],
                ];
            });

        return response()->json($events);
    }

    public function publicCalendarMonth(Request $request)
    {
        $year  = $request->year;
        $month = $request->month;

        $events = CalendarYear::whereYear('event_date', $year)
            ->whereMonth('event_date', $month)
            ->orderBy('event_date')
            ->get()
            ->map(function ($event) {
                return [
                    'id'          => $event->id,
                    'title'       => $event->title,
                    'description' => $event->description,
                    'event_type'  => $event->event_type,
                    'date'        => $event->event_date->format('d M Y'),
                    'link'        => $event->link,
                    'image'       => $event->image,
                ];
            });

        return response()->json($events);
    }
}
