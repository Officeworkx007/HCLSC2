<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryAlbum;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Log;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = GalleryAlbum::withCount('photos')
            ->orderBy('event_date', 'desc')
            ->get(); // IMPORTANT — NO paginate()

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

        $album = null; // Initialize $album outside try block for cleanup
        $pathPrefix = null; // Initialize $pathPrefix

        // 2. Transaction and Storage
        try {
            DB::beginTransaction();

            // 2A. Create the Album Record
            $album = GalleryAlbum::create([
                'title' => $request->input('title'),
                'event_date' => $request->input('event_date'),
                'description' => $request->input('description'),
            ]);

            // 2B. Define the storage path after album creation
            $pathPrefix = 'albums/' . date('Y', strtotime($album->event_date)) . '/' . $album->id;

            $photosToInsert = [];
            $order = 1;

            // 2C. Loop, Store Files, and Prepare Photo Records
            foreach ($request->file('album_photos') as $photoFile) {
                // The directory will be created if it doesn't exist
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

            // 2D. Insert Photo Records
            if (!empty($photosToInsert)) {
                $photosToInsert[0]['is_cover'] = true;
                GalleryPhoto::insert($photosToInsert);
            }

            DB::commit();

            return redirect()->route('admin.photo_gallery.index')
                ->with('success', "Album '{$album->title}' and {$album->photos()->count()} photos created successfully!");
        } catch (\Exception $e) {
            DB::rollBack();

            // If the transaction fails, remove the uploaded folder from storage/app/public
            if ($pathPrefix) {
                // Storage::deleteDirectory is recursive and handles the entire folder
                Storage::disk('public')->deleteDirectory($pathPrefix);
            }

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

    public function destroy(GalleryAlbum $album)
    {
        // 1. Define the base path for cleanup
        // We replicate the path structure used in the 'store' method.
        $pathToDelete = 'albums/' . date('Y', strtotime($album->event_date)) . '/' . $album->id;

        try {
            DB::beginTransaction();

            // 2. Delete the associated photos (DB records)
            // Note: If you use Model events (like 'deleting'), this is safer than a raw DELETE.
            // Using the album's relationship for deletion ensures foreign key safety.
            $album->photos()->delete();

            // 3. Delete the album record itself
            $album->delete();

            // 4. Delete the physical directory from the disk
            // NOTE: This must happen AFTER the album model is deleted if you use Model events.
            // Storage::deleteDirectory is recursive, deleting the folder and all contents.
            Storage::disk('public')->deleteDirectory($pathToDelete);

            DB::commit();

            return redirect()->route('admin.photo_gallery.index')
                ->with('success', "Album '{$album->title}' and all associated photos deleted successfully!");
        } catch (\Exception $e) {
            DB::rollBack();

            // Log the error for debugging
            \Log::error("Failed to delete album {$album->id}: " . $e->getMessage());

            return back()
                ->with('error', 'Failed to delete the album due to an error: ' . $e->getMessage());
        }
    }

    // 💡 Add the DESTROY method for deleting individual photos
    public function destroyPhoto(GalleryAlbum $album, GalleryPhoto $photo)
    {
        // Ensure the photo belongs to the album (security check)
        if ($photo->gallery_album_id !== $album->id) {
            abort(404);
        }

        try {
            DB::beginTransaction();

            // 1. Delete the file from the storage disk
            Storage::disk('public')->delete($photo->file_path);

            // 2. Delete the database record
            $photo->delete();

            DB::commit();

            return back()->with('success', 'Photo deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to delete photo: ' . $e->getMessage());
        }
    }
}
