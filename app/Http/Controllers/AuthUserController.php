<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        dd($request->all());
    }

}
