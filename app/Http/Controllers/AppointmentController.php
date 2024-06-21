<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\Worker;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    
    public function index()
    {
        $treatments = Treatment::all();
        return view('appointment', compact('treatments'));
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
