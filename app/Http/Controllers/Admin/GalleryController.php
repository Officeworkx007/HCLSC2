<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        return view('admin.photo_gallery.create');
    }
}
