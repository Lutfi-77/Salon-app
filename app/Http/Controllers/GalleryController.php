<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    
    public function index()
    {
        $images = Gallery::paginate(15);
        return view('gallery', compact('images'));
    }

}
