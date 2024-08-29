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
        $userLogedIn = Auth::user();
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

            }
            if($savedDetailAppointment){
                Alert::toast('Booking berhasil', 'success');
                return redirect()->route('user.dashboard');
            }
            Alert::error('Booking Gagal', 'Terjadi kesalahan');
            return redirect()->back();
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
        $appointment = DetailAppointment::find($id);
        // $treatments = Treatment::all();
        return view('users.appointment.edit', compact('appointment'));
    }

    public function update(Request $request, $id)
    {
        $detailAppointment = DetailAppointment::find($id);
        $validated = $request->validate([
            'date' => 'required',
            'time' => 'required',
        ]);
        $detailAppointment->reschedule_date = $request->date;
        $detailAppointment->reschedule_time = $request->time;
        $savedDetailAppointment = $detailAppointment->save();
        if($savedDetailAppointment){
            Alert::toast('Reschedule Berhasil', 'success');
            return redirect()->route('user.dashboard');
        }
        Alert::toast('Reschedule Gagal', 'error');
        return redirect()->back();
        // $appointment = Appointment::find($id);
        // if(!$appointment){
        //     Alert::error('Booking Gagal', 'Data tidak ditemukan');
        //     return redirect()->back();
        // }
        // $appointment->date = $request->date;
        // $appointment->time = $request->time;
        // $save = $appointment->save();
        // if($save){
        //     Alert::toast('Reschedule berhasil', 'success');
        //     return redirect()->route('user.dashboard');
        // }
        // Alert::error('Booking Gagal', 'Terjadi kesalahan');
        // return redirect()->back();
    }

    public function detail($id)
    {
        $detailAppointments = DetailAppointment::where('appointment_id', $id)->get();
        return view('users.appointment.detail', compact('detailAppointments'));
    }

    public function cancel($id)
    {
        $detailAppointment = DetailAppointment::find($id);
        $detailAppointment->status_worker = 'batal';
        $detailAppointment->save();
        Alert::toast('Treatment Dibatalkan', 'success');
        return redirect()->route('user.dashboard');
    }

    public function getWorker($id_treatment = null)
    {
        $worker = Worker::where('treatment_id', $id_treatment)->with('user')->get();
    
        if ($worker) {
            return response()->json($worker);
        }
        return response()->json(['error' => 'Worker not found'], 404);
    }

    public function getAvailableTimes($date)
    {
        // Retrieve all appointments for the given date
        $appointments = Appointment::whereDate('appointment_date', $date)->pluck('appointment_time');

        // Define all possible time slots
        $allTimes = ["09:00", "11:00", "13:00", "15:00", "17:00", "19:00", "21:00"];

        // Filter out times that are already booked
        $availableTimes = array_values(array_diff($allTimes, $appointments->toArray()));

        return response()->json($availableTimes);
    }

}
