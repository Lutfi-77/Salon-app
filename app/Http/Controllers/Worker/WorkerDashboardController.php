<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;

class WorkerDashboardController extends Controller
{
    public function index()
    {
        $userLogedIn = Auth::user()->worker;
        $appointments = Appointment::where('worker_id', $userLogedIn->id)->get();
        return view('worker.dashboard', compact('appointments'));
    }

    public function changeStatus($id, $status)
    {
        $appointment = Appointment::find($id);
        $appointment->status = $status;
        $save = $appointment->save();
        if($save){
            Alert::toast('Data berhasil diubah', 'success');
            return redirect()->route('worker.dashboard');
        }

        Alert::error('Terjadi Kesalahan', 'Status Gagal Diubah');
        return redirect()->route('worker.dashboard');
    }
}
