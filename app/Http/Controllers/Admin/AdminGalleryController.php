<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Storage;

class AdminGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Gallery::all();
        $title = 'Delete Image!';
        $text = "Yakin mau dihapus?";
        confirmDelete($title, $text);

        return view('admin.gallery.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->file);
        // return $request->file;
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // $images = $image->store('/images');
                $model = new Gallery;
                $images = $image->store('/images');
                $model->url = $images;
                $model->save();
            }
        }else{
            return false;
        }
        
        Alert::toast('File berhasil diupload', 'success');
        return true;
        // dd($request->file('images'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $images = Gallery::find($id);
        if($images){
            Storage::delete($images->url);
            $images->delete();
            Alert::toast('Gambar berhasil dihapus', 'success');
            return redirect()->back();
        }else{
            Alert::toast('Gambar tidak tersedia untuk dihapus', 'error');
            return redirect()->back();
        }
    }
}
