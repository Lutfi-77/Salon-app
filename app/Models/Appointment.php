<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    // protected $primaryKey = 'id';

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function detail()
    {
        return $this->hasMany(DetailAppointment::class, 'appointment_id');
    }
    
    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

}
