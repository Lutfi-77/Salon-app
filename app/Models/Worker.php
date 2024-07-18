<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'address',
        'price',
        'image',
        'user_id',
        'treatment_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }
    
    public function detailAppointment()
    {
        return $this->hasMany(DetailAppointment::class, 'worker_id');
    }
    
}
