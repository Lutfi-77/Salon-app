<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    
    public function index()
    {
        $userLogedIn = Auth::user();
        $appointments = Appointment::where('user_id', $userLogedIn->id)->get();
        // dd($appointments[0]->detail->where('reschedule_time', '!=', null))->count();
        return view('users.dashboard', compact('appointments', 'userLogedIn'));
    }

}
