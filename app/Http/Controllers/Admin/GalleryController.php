<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryAlbum;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = GalleryAlbum::withCount('photos')
            ->latest('event_date') // Order by event date, newest first
            ->paginate(5); // Adjust pagination limit as needed

        return view('admin.photo_gallery.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.photo_gallery.create');
    }

    public function store(Request $request)
    {
        // 1. Validation
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'event_date' => 'required|date',
                'description' => 'nullable|string',
                'album_photos' => 'required|array|min:1',
                'album_photos.*' => 'mimes:jpeg,jpg,png|max:10240',
            ], [
                'album_photos.min' => 'You must upload at least one photo for the album.',
                'album_photos.*.mimes' => 'All uploaded files must be in JPEG or PNG format.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withInput()->withErrors($e->errors());
        }

        // 2. Transaction and Storage
        try {
            DB::beginTransaction();

            // **2A. Create the Album Record** (This is the most likely failure point if tables are mismatched)
            $album = GalleryAlbum::create([
                'title' => $request->input('title'),
                'event_date' => $request->input('event_date'),
                'description' => $request->input('description'),
            ]);

            // **2B. Define the storage path**
            $pathPrefix = 'albums/' . date('Y', strtotime($album->event_date)) . '/' . $album->id;

            $photosToInsert = [];
            $order = 1;

            // **2C. Loop, Store Files, and Prepare Photo Records**
            foreach ($request->file('album_photos') as $photoFile) {
                $filePath = Storage::disk('public')->put($pathPrefix, $photoFile);

                $photosToInsert[] = [
                    'gallery_album_id' => $album->id,
                    'file_path' => $filePath,
                    'file_name' => $photoFile->getClientOriginalName(),
                    'order_column' => $order++,
                    'is_cover' => false,
                    'caption' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // **2D. Insert Photo Records**
            if (!empty($photosToInsert)) {
                $photosToInsert[0]['is_cover'] = true;
                GalleryPhoto::insert($photosToInsert);
            }

            DB::commit();

            return redirect()->route('admin.photo_gallery.index')
                ->with('success', "Album '{$album->title}' and {$album->photos()->count()} photos created successfully!");
        } catch (\Exception $e) {
            DB::rollBack();

            // 🛑 CRITICAL DEBUG DUMP 🛑
            // This will expose the exact database/file storage error message and line number.
            dd(
                "FATAL STORE EXCEPTION:",
                "Message: " . $e->getMessage(),
                "File: " . $e->getFile(),
                "Line: " . $e->getLine()
            );

            return back()
                ->withInput()
                ->with('error', 'An error occurred while creating the album: ' . $e->getMessage());
        }
    }

    public function show(GalleryAlbum $album)
    {
        // Eager load the photos relationship
        $album->load('photos');

        return view('admin.photo_gallery.show', compact('album'));
    }
}
