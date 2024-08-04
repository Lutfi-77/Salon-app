<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Alert;
use App\Models\DetailAppointment;

class AdminTransactionController extends Controller
{

    public function checkStatus()
    {
        // $appointmentsToUpdate = Appointment::whereHas('detail', function ($query) {
        //     $query->where('status_worker', 'selesai');
        // })->whereDoesntHave('detail', function ($query) {
        //     $query->where('status_worker', 'menunggu');
        // })->get();
        // // dd($appointmentsToUpdate);
        // foreach ($appointmentsToUpdate as $appointment) {
        //     $appointment->update(['status' => 'selesai']);
        // }
        $appointmentsToUpdate = Appointment::whereDoesntHave('detail', function ($query) {
            $query->whereNotIn('status_worker', ['selesai', 'batal']);
        })->get();
        
        // Update status appointment to selesai when all status_worker equal to selesai or selesai and batal
        foreach ($appointmentsToUpdate as $appointment) {
            $appointment->update(['status' => 'selesai']);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index($filter = null)
    {
        $this->checkStatus();
        $transactions = Transaction::all();
        if($filter == null){
            $appointments = Appointment::doesntHave('transaction')->get();
        }else{
            $appointments = Appointment::doesntHave('transaction')->where('status', 'selesai')->get();
        }
        // dd($appointments[0]->detail);
        return view('admin.transaction.appointment', compact('transactions', 'appointments'));
    }

    public function indexTransaction()
    {
        $transactions = Transaction::all();
        return view('admin.transaction.index', compact('transactions'));
    }

    public function completeAppointment($id)
    {
        $appointment = Appointment::find($id);
        if(!$appointment){
            Alert::toast('Terjadi kesalahan', 'error');
            return redirect()->route('admin.transaction.index');
        }
        // $appointment->detail()->update(['status_worker' => "selesai"]);
        $cek = $appointment->detail()->whereIn('status_worker', ['menunggu'])->get();
        // dd(!$cek->isEmpty());
        if (!$cek->isEmpty()) {
            Alert::toast('Masih ada appointment yang memiliki status Menunggu', 'error');
            return redirect()->back();
        }

        $changeStatus = $appointment->detail()
        ->whereIn('status_worker', ['diterima', 'selesai'])
        ->where('status_worker', '!=', 'batal')
        ->update(['status_worker' => 'selesai']);

        $appointment->status = 'selesai';
        $appointment->save();

        Alert::toast('Data berhasil tersimpan', 'success');
        return redirect()->route('admin.appointment.index');
    }

    public function paymentView($id){
        $appointment = Appointment::with(['detail' => function ($query) {
            $query->where('status_worker', 'selesai');
        }])->where('id', $id)->first();
        // dd($appointment->detail);
        return view('admin.transaction.payment', compact('appointment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $appointment = Appointment::find($id);
        $transaction = new Transaction;
        if(!$appointment){
            Alert::toast('Terjadi kesalahan', 'error');
            return redirect()->route('admin.transaction.index');
        }
        $transaction->appointment_id = $id;
        $transaction->customer_id = $appointment->user_id;
        $transaction->total_price = $request->total_price;
        $transaction->status = 'sudah terbayar';
        $transaction->save();

        Alert::toast('Data berhasil tersimpan', 'success');
        return redirect()->route('admin.transaction.invoice', $transaction->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $detailAppointments = DetailAppointment::where('appointment_id', $id)->get();
        return view('admin.transaction.detail', compact('detailAppointments'));
    }

    public function changeStatus($id, $status)
    {
        $detailAppointment = DetailAppointment::find($id);
        if(!$detailAppointment){
            Alert::toast('Terjadi kesalahan', 'error');
            return redirect()->route('admin.transaction.index');
        }
        $detailAppointment->status_worker = $status;
        $detailAppointment->save();
        Alert::toast('Data berhasil tersimpan', 'success');
        return redirect()->route('admin.appointment.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function invoice($id)
    {
        $transaction = Transaction::find($id);
        // dd($transaction->appointment);
        return view('admin.invoice', compact('transaction'));
    }
}
