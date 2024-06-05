<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
Use Alert;

class AuthUserController extends Controller
{
    
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function storeRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'confirmed'
        ]);
        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = 'customer';
        $user->save();

        Alert::success('Berhasil', 'Data berhasil di registrasi');
        return redirect()->route('user.login');
    }

}
