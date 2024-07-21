<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAppointment extends Model
{
    // protected $primaryKey = 'id';

    use HasFactory;

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function detailTreatment()
    {
        return $this->belongsTo(Treatment::class, 'treatment_id');
    }
    
    public function getWorker()
    {
        return $this->belongsTo(Worker::class, 'worker_id');
    }

}
