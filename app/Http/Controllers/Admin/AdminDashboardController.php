<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    
    public function index()
    {
        $workers = User::where('role', 'worker')->get();
        return view('admin.dashboard', compact('workers'));
    }
    
}
