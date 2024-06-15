<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Category;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Storage;

class AdminCatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catalogues = Catalogue::all();
        $title = 'Delete Account!';
        $text = "Yakin mau dihapus?";
        confirmDelete($title, $text);
        return view('admin.catalogue.index', compact('catalogues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.catalogue.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $catalogue = new Catalogue;
        $validated = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'image' => 'required|mimes:jpg,bmp,png',
        ]);

        $catalogue->title = $request->title;
        $catalogue->category_id = $request->category;
        if( $request->hasFile('image') ){
            $catalogue->image = $request->file('image')->store('/catalogue');
        }

        $catalogue->save();

        Alert::toast('Data berhasil ditambahkan', 'success');
        return redirect()->route('admin.catalogue.index');
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
        $catalogue = Catalogue::find($id);
        $categories = Category::all();
        return view('admin.catalogue.edit', compact('catalogue', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $catalogue = Catalogue::find($id);
        $validated = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'image' => 'mimes:jpg,bmp,png',
        ]);

        $catalogue->title = $request->title;
        $catalogue->category_id = $request->category;
        if( $request->hasFile('image') ){
            $catalogue->image = $request->file('image')->store('/catalogue');
        }
        // $catalogue->image = $catalogue->image;

        $catalogue->save();

        Alert::toast('Data berhasil diubah', 'success');
        return redirect()->route('admin.catalogue.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $catalogue = Catalogue::find($id);
        if($catalogue){
            if($catalogue->image){
                Storage::delete($catalogue->image);
                // dd("masuk");
            }
            $catalogue->delete();
            Alert::toast('Gambar berhasil dihapus', 'success');
            return redirect()->back();
        }else{
            Alert::toast('Gambar tidak tersedia untuk dihapus', 'error');
            return redirect()->back();
        }
    }
}
