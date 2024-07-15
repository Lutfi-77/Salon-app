<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Treatment;
use App\Models\Worker;
use App\Models\DetailAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Alert;

class AppointmentController extends Controller
{
    
    public function index()
    {
        $treatments = Treatment::all();
        return view('users.appointment.appointment', compact('treatments'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $userLogedIn = Auth::user();
        // dd($userLogedIn);
        $appointment = new Appointment;

        // Validasi request
        $validated = $request->validate([
            'appointment' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        // mengolah data array
        $appointment_details = Arr::map($request->appointment, function ($value, $key){
            return json_decode($value); //ubah menjadi object
        });

        $appointment->user_id = $userLogedIn->id;
        $appointment->appointment_date = $request->date;
        $appointment->appointment_time = $request->time;
        
        if ($appointment->save()){
            foreach ($appointment_details as $appointment_detail) {
                $treatmentName = Treatment::find($appointment_detail->treatmentId);
                $worker = Worker::find($appointment_detail->workerId);
                
                if(!$treatmentName || !$worker){
                    Alert::error('Booking Gagal', 'Treatment yang dipilih tidak terdaftar');
                    return redirect()->back();
                }
                
                $detailAppointment = new DetailAppointment;
                $detailAppointment->appointment_id = $appointment->id;
                $detailAppointment->treatment_id = $appointment_detail->treatmentId;
                $detailAppointment->worker_id = $appointment_detail->workerId;
                $detailAppointment->treatment = $treatmentName->name;
                $detailAppointment->worker = $worker->user->name;
                $detailAppointment->price = $worker->price;
                $savedDetailAppointment = $detailAppointment->save();

                if($savedDetailAppointment){
                    Alert::toast('Booking berhasil', 'success');
                    return redirect()->route('user.dashboard');
                }
                Alert::error('Booking Gagal', 'Terjadi kesalahan');
                return redirect()->back();
            }
        }

        Alert::error('Booking Gagal', 'Terjadi kesalahan');
        return redirect()->back();
               
        // // dd($treatmentName);
        // if(!$treatmentName){
        //     Alert::error('Booking Gagal', 'Treatment yang dipilih tidak terdaftar');
        //     return redirect()->back();
        // }
        // $appointment = new Appointment;
        // $appointment->user_id = $userLogedIn->id;
        // $appointment->treatment_id = $request->treatment;
        // $appointment->worker_id = $request->worker;
        // $appointment->treatment = $treatmentName->name;
        // $appointment->date = $request->date;
        // $appointment->time = $request->time;
        // $appointment->status = 'Menunggu';
        
        // $save = $appointment->save();
        // if($save){
        //     Alert::toast('Booking berhasil', 'success');
        //     return redirect()->route('user.dashboard');
        // }
        // Alert::error('Booking Gagal', 'Terjadi kesalahan');
        // return redirect()->back();
    }

    public function edit($id)
    {
        $appointment = Appointment::find($id);
        $treatments = Treatment::all();
        return view('users.appointment.edit', compact('appointment', 'treatments'));
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::find($id);
        if(!$appointment){
            Alert::error('Booking Gagal', 'Data tidak ditemukan');
            return redirect()->back();
        }
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $save = $appointment->save();
        if($save){
            Alert::toast('Reschedule berhasil', 'success');
            return redirect()->route('user.dashboard');
        }
        Alert::error('Booking Gagal', 'Terjadi kesalahan');
        return redirect()->back();
    }

    public function getWorker($id_treatment = null)
    {
        $worker = Worker::where('treatment_id', $id_treatment)->with('user')->get();
    
        if ($worker) {
            return response()->json($worker);
        }
        return response()->json(['error' => 'Worker not found'], 404);
    }

}
