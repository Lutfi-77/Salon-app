<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index()
    {
        $workers = User::where('role', 'worker')->get();
        $price_list = Treatment::paginate(6);
        $treatments = Treatment::all();
        return view('home', compact('workers', 'price_list', 'treatments'));
    }

}
