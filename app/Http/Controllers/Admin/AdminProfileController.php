<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Alert;

class AdminProfileController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function editProfile(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $validated = $request->validate([
            'password' => 'confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->role = 'admin';
        $user->save();

        Alert::toast('Data berhasil diubah', 'success');

        Auth::logout();

        return redirect()->route('admin.login');
    }

}
