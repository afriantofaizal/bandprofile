<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;

class GalleryController extends Controller
{
    //
    public function index()
    {
        $galleries = Gallery::latest()->approved()->published()->simplePaginate(6);

        return view('gallery.index', compact('galleries'));

    }
}
