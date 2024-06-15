<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index()
    {
        $workers = User::where('role', 'worker')->get();
        return view('home', compact('workers'));
    }

}
