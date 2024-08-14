<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';
    protected $fillable = [
        'patient_id',
        'appointment_date',
        'appointment_reason',

    ];

    public function patients(){
        return $this->belongsTo(Patients::class);
    }

    public function doctors() {
        return $this->belongsTo(Doctor::class);
    }
}
