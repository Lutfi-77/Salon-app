<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function detail()
    {
        return $this->hasMany(DetailAppointment::class);
    }

}
