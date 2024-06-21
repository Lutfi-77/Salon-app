<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Treatment;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;

class AppointmentController extends Controller
{
    
    public function index()
    {
        $treatments = Treatment::all();
        return view('appointment', compact('treatments'));
    }

    public function store(Request $request)
    {
        $userLogedIn = Auth::user();
        $treatmentName = Treatment::find($request->treatment);
        $validated = $request->validate([
            'treatment' => 'required',
            'worker' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);
        // dd($treatmentName);
        if(!$treatmentName){
            Alert::error('Booking Gagal', 'Treatment yang dipilih tidak terdaftar');
            return redirect()->back();
        }
        $appointment = new Appointment;
        $appointment->user_id = $userLogedIn->id;
        $appointment->treatment_id = $request->treatment;
        $appointment->worker_id = $request->worker;
        $appointment->treatment = $treatmentName->name;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->approve = '0';
        
        $save = $appointment->save();
        if($save){
            Alert::toast('Booking berhasil', 'success');
            return redirect()->route('user.dashboard');
        }
        Alert::error('Booking Gagal', 'Terjadi kesalahan');
        return redirect()->back();
    }

    public function getWorker($id_treatment)
    {
        $worker = Worker::where('treatment_id', $id_treatment)->with('user')->get();
    
        if ($worker) {
            return response()->json($worker);
        }
        return response()->json(['error' => 'Worker not found'], 404);
    }

}
