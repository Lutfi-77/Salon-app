<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Storage;

class AdminTreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $treatments = Treatment::all();
        $title = 'Delete Treatment!';
        $text = "Yakin mau dihapus?";
        confirmDelete($title, $text);
        return view('admin.treatment.index', compact('treatments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.treatment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'image' => 'required|mimes:jpg,bmp,png,jpeg,webp',
        ]);

        $treatment = new Treatment;
        $treatment->name = $request->name;
        $treatment->desc = $request->desc;
        $treatment->price = $request->price;
        $treatment->image = $request->file('image')->store('/treatment_img');
        $treatment->save();

        Alert::toast('Data berhasil ditambahkan', 'success');
        return redirect()->route('admin.treatment.index');
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
        $treatment = Treatment::find($id);
        return view('admin.treatment.edit', compact('treatment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpg,bmp,png,jpeg,webp',
        ]);

        $treatment = Treatment::find($id);
        $treatment->name = $request->name;
        $treatment->desc = $request->desc;
        $treatment->price = $request->price;
        $treatment->image = $request->file('image') ? $request->file('image')->store('/treatment_img') : $treatment->image;
        $treatment->save();

        Alert::toast('Data berhasil diubah', 'success');
        return redirect()->route('admin.treatment.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $treatment = Treatment::find($id);
        if($treatment){
            Storage::delete($treatment->image);
            $treatment->delete();
            Alert::toast('Gambar berhasil dihapus', 'success');
            return redirect()->back();
        }else{
            Alert::toast('Gambar tidak tersedia untuk dihapus', 'error');
            return redirect()->back();
        }
    }
}
