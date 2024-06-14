<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Alert;

class AdminManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'admin')->get();
        $title = 'Delete Account!';
        $text = "Yakin mau dihapus?";
        confirmDelete($title, $text);
        return view('admin.adminAcc.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.adminAcc.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User;
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = "admin";
        $user->save();

        Alert::toast('Data berhasil ditambahkan', 'success');
        return redirect()->route('admin.manage.index');
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
        $user = User::find($id);
        return view('admin.adminAcc.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'confirmed',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->role = 'admin';
        $user->save();

        Alert::toast('Data berhasil ditambahkan', 'success');
        return redirect()->route('admin.manage.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if($user){
            $user->delete();
            Alert::toast('Akun berhasil dihapus', 'success');
            return redirect()->back();
        }else{
            Alert::toast('Akun tidak ditemukan', 'error');
            return redirect()->back();
        }
    }
}
