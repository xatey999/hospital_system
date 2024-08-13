<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;

    protected $table = 'patients';
    protected $fillable = [
        'date_of_birth',
        'gender',
        'address',
        'user_id',
    ];

    public function appointment(){
        return $this->hasMany(Appointment::class);
    }
}
