<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctors';
    protected $fillable = [
        'doctor_name',
        'doctor_description',
        'doctor_phone',
        'department_id',
        'user_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}


