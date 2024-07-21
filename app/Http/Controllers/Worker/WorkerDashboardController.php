<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;
use App\Models\DetailAppointment;

class WorkerDashboardController extends Controller
{
    public function index()
    {
        $userLogedIn = Auth::user()->worker;
        // $appointments = Appointment::whereHas('detail', function (Builder $query){
        //     $test = $query->where('worker_id', Auth::user()->worker->id)->get();
        //     dd($test);
        // })->get();
        // $appointments = Appointment::with(['detail' => function($query) {
        //     $query->where('worker_id', '=', 3);
        // }])->get();
        // dd($appointments[0]->detail);
        $appointments = DetailAppointment::orderBy('created_at', 'DESC')->where('worker_id', Auth::user()->worker->id)->get();
        // dd($appointments[0]->appointment->user->name);
        return view('worker.dashboard', compact('appointments', 'userLogedIn'));
    }

    public function changeStatus($id, $status)
    {
        $appointment = DetailAppointment::find($id);
        $appointment->status_worker = $status;
        $save = $appointment->save();
        if($save){
            Alert::toast('Data berhasil diubah', 'success');
            return redirect()->route('worker.dashboard');
        }

        Alert::error('Terjadi Kesalahan', 'Status Gagal Diubah');
        return redirect()->route('worker.dashboard');
    }
}
